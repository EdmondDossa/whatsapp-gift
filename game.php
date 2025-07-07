<?php
// game.php - API simple pour gérer les numéros
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

$dataFile = 'game_data.json';

// Fonction pour lire les données
function readGameData() {
    global $dataFile;
    if (!file_exists($dataFile)) {
        $initialData = [
            'availableNumbers' => range(1, 12),
            'usedNumbers' => [],
            'deviceAssignments' => []
        ];
        file_put_contents($dataFile, json_encode($initialData));
        return $initialData;
    }
    return json_decode(file_get_contents($dataFile), true);
}

// Fonction pour sauvegarder les données
function saveGameData($data) {
    global $dataFile;
    file_put_contents($dataFile, json_encode($data));
}

// Fonction pour obtenir un verrou (éviter les conflits)
function getLock() {
    $lockFile = 'game.lock';
    $handle = fopen($lockFile, 'w');
    if (flock($handle, LOCK_EX)) {
        return $handle;
    }
    return false;
}

// Fonction pour libérer le verrou
function releaseLock($handle) {
    flock($handle, LOCK_UN);
    fclose($handle);
}

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

switch ($method) {
    case 'GET':
        // Récupérer l'état du jeu
        $data = readGameData();
        echo json_encode([
            'success' => true,
            'data' => $data,
            'remainingCount' => count($data['availableNumbers'])
        ]);
        break;
        
    case 'POST':
        // Attribuer un numéro
        $deviceId = $input['deviceId'] ?? '';
        $specialNumber = $input['specialNumber'] ?? null;
        $specialNumbers = [1, 2, 3, 4];
        
        if (empty($deviceId)) {
            echo json_encode(['success' => false, 'message' => 'Device ID requis']);
            break;
        }
        
        $lock = getLock();
        if (!$lock) {
            echo json_encode(['success' => false, 'message' => 'Impossible d\'obtenir le verrou']);
            break;
        }
        
        $data = readGameData();
        
        // Vérifier si l'appareil a déjà un numéro
        if (isset($data['deviceAssignments'][$deviceId])) {
            releaseLock($lock);
            echo json_encode([
                'success' => false, 
                'message' => 'Appareil déjà utilisé',
                'assignedNumber' => $data['deviceAssignments'][$deviceId]
            ]);
            break;
        }
        
        $selectedNumber = null;
        
        if ($specialNumber && in_array($specialNumber, $specialNumbers)) {
            // Numéro spécial demandé
            if (in_array($specialNumber, $data['availableNumbers'])) {
                $selectedNumber = $specialNumber;
            } else {
                releaseLock($lock);
                echo json_encode([
                    'success' => false, 
                    'message' => "Le numéro spécial {$specialNumber} n'est plus disponible"
                ]);
                break;
            }
        } else {
            // Numéro normal (exclure les spéciaux)
            $availableNormal = array_diff($data['availableNumbers'], $specialNumbers);
            if (empty($availableNormal)) {
                releaseLock($lock);
                echo json_encode([
                    'success' => false, 
                    'message' => 'Aucun numéro disponible'
                ]);
                break;
            }
            $selectedNumber = $availableNormal[array_rand($availableNormal)];
        }
        
        // Attribuer le numéro
        $data['availableNumbers'] = array_values(array_diff($data['availableNumbers'], [$selectedNumber]));
        $data['usedNumbers'][] = $selectedNumber;
        $data['deviceAssignments'][$deviceId] = $selectedNumber;
        
        saveGameData($data);
        releaseLock($lock);
        
        echo json_encode([
            'success' => true,
            'number' => $selectedNumber,
            'isSpecial' => in_array($selectedNumber, $specialNumbers),
            'remainingCount' => count($data['availableNumbers'])
        ]);
        break;
        
    case 'DELETE':
        // Réinitialiser le jeu (admin)
        $password = $input['password'] ?? '';
        if ($password !== 'admin123') { // Changez ce mot de passe !
            echo json_encode(['success' => false, 'message' => 'Mot de passe incorrect']);
            break;
        }
        
        $lock = getLock();
        if (!$lock) {
            echo json_encode(['success' => false, 'message' => 'Impossible d\'obtenir le verrou']);
            break;
        }
        
        $initialData = [
            'availableNumbers' => range(1, 12),
            'usedNumbers' => [],
            'deviceAssignments' => []
        ];
        
        saveGameData($initialData);
        releaseLock($lock);
        
        echo json_encode(['success' => true, 'message' => 'Jeu réinitialisé']);
        break;
        
    default:
        echo json_encode(['success' => false, 'message' => 'Méthode non supportée']);
        break;
}
?>