<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cadeau Mystère</title>
    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      body {
        min-height: 100vh;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: "Arial", sans-serif;
        overflow: hidden;
      }

      .container {
        text-align: center;
        position: relative;
      }

      .title {
        color: white;
        font-size: 2.5em;
        margin-bottom: 30px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        animation: glow 2s ease-in-out infinite alternate;
      }

      @keyframes glow {
        from {
          text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3),
            0 0 10px rgba(255, 255, 255, 0.2);
        }
        to {
          text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3),
            0 0 20px rgba(255, 255, 255, 0.4);
        }
      }

      .gift-box {
        width: 200px;
        height: 200px;
        position: relative;
        margin: 0 auto;
        cursor: pointer;
        transition: transform 0.3s ease;
      }

      .gift-box:hover {
        transform: scale(1.05);
      }

      .box-base {
        width: 200px;
        height: 150px;
        background: linear-gradient(45deg, #ff6b6b, #ee5a24);
        border-radius: 10px;
        position: absolute;
        bottom: 0;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        border: 3px solid #c44569;
      }

      .box-lid {
        width: 210px;
        height: 60px;
        background: linear-gradient(45deg, #ff7675, #fd79a8);
        border-radius: 10px 10px 5px 5px;
        position: absolute;
        top: 0;
        left: -5px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        border: 3px solid #e84393;
        transition: all 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        transform-origin: bottom;
      }

      .ribbon-vertical {
        width: 20px;
        height: 200px;
        background: linear-gradient(90deg, #ffd700, #ffed4e);
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        border: 2px solid #f39c12;
        box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.1);
      }

      .ribbon-horizontal {
        width: 210px;
        height: 20px;
        background: linear-gradient(90deg, #ffd700, #ffed4e);
        position: absolute;
        top: 50%;
        left: -5px;
        transform: translateY(-50%);
        border: 2px solid #f39c12;
        box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.1);
      }

      .bow {
        width: 60px;
        height: 40px;
        background: #ffd700;
        position: absolute;
        top: -10px;
        left: 50%;
        transform: translateX(-50%);
        border-radius: 50% 50% 50% 50% / 60% 60% 40% 40%;
        border: 2px solid #f39c12;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
      }

      .bow::before {
        content: "";
        width: 20px;
        height: 30px;
        background: #f39c12;
        position: absolute;
        top: 5px;
        left: 50%;
        transform: translateX(-50%);
        border-radius: 50%;
      }

      .sparkles {
        position: absolute;
        width: 100%;
        height: 100%;
        pointer-events: none;
      }

      .sparkle {
        position: absolute;
        width: 4px;
        height: 4px;
        background: white;
        border-radius: 50%;
        animation: sparkle 2s linear infinite;
      }

      @keyframes sparkle {
        0% {
          opacity: 0;
          transform: scale(0) rotate(0deg);
        }
        50% {
          opacity: 1;
          transform: scale(1) rotate(180deg);
        }
        100% {
          opacity: 0;
          transform: scale(0) rotate(360deg);
        }
      }

      .confetti-container {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 1000;
      }

      .confetti {
        position: absolute;
        width: 10px;
        height: 10px;
        opacity: 0;
      }

      .confetti.square {
        background: #ff6b6b;
        transform: rotate(45deg);
      }

      .confetti.circle {
        background: #4ecdc4;
        border-radius: 50%;
      }

      .confetti.triangle {
        width: 0;
        height: 0;
        border-left: 5px solid transparent;
        border-right: 5px solid transparent;
        border-bottom: 10px solid #ffd700;
      }

      .confetti.star {
        background: #ff9ff3;
        clip-path: polygon(
          50% 0%,
          61% 35%,
          98% 35%,
          68% 57%,
          79% 91%,
          50% 70%,
          21% 91%,
          32% 57%,
          2% 35%,
          39% 35%
        );
      }

      @keyframes confetti-fall {
        0% {
          transform: translateY(-100vh) rotate(0deg);
          opacity: 1;
        }
        100% {
          transform: translateY(100vh) rotate(720deg);
          opacity: 0;
        }
      }

      .number-animation {
        position: absolute;
        top: 50%;
        left: 50%;
        font-size: 6em;
        font-weight: bold;
        color: #ffd700;
        text-shadow: 0 0 20px rgba(255, 215, 0, 0.8),
          0 0 40px rgba(255, 215, 0, 0.6), 0 0 60px rgba(255, 215, 0, 0.4),
          3px 3px 0px #ff6b6b, 6px 6px 0px #4ecdc4;
        z-index: 500;
        pointer-events: none;
        opacity: 0;
        transform: translate(-50%, -50%) scale(0.1) rotate(0deg);
      }

      .number-animation.show {
        animation: numberEmerge 3s cubic-bezier(0.68, -0.55, 0.265, 1.55)
          forwards;
      }

      @keyframes numberEmerge {
        0% {
          opacity: 0;
          transform: translate(-50%, -50%) scale(0.1) rotate(0deg);
        }
        30% {
          opacity: 1;
          transform: translate(-50%, -50%) scale(1.5) rotate(180deg);
        }
        60% {
          transform: translate(-50%, -50%) scale(1.2) rotate(360deg);
        }
        80% {
          transform: translate(-50%, -50%) scale(1.1) rotate(540deg);
        }
        100% {
          opacity: 1;
          transform: translate(-50%, -50%) scale(1) rotate(720deg);
        }
      }

      .opened .box-lid {
        transform: rotateX(-120deg);
      }

      .result {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: white;
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        opacity: 0;
        visibility: hidden;
        transition: all 0.5s ease;
        border: 3px solid #ffd700;
      }

      .result.show {
        opacity: 1;
        visibility: visible;
        animation: bounceIn 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55);
      }

      @keyframes bounceIn {
        0% {
          transform: translate(-50%, -50%) scale(0.3);
        }
        50% {
          transform: translate(-50%, -50%) scale(1.05);
        }
        70% {
          transform: translate(-50%, -50%) scale(0.9);
        }
        100% {
          transform: translate(-50%, -50%) scale(1);
        }
      }

      .number {
        font-size: 4em;
        font-weight: bold;
        color: #667eea;
        margin-bottom: 10px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
      }

      .message {
        font-size: 1.2em;
        color: #333;
        margin-bottom: 20px;
      }

      .click-instruction {
        color: white;
        font-size: 1.2em;
        margin-top: 20px;
        animation: pulse 2s infinite;
      }

      .special-number {
        background: linear-gradient(45deg, #ff6b6b, #ffd700, #4ecdc4, #ff9ff3);
        background-size: 400% 400%;
        animation: rainbowGlow 2s ease infinite;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
      }

      @keyframes rainbowGlow {
        0% {
          background-position: 0% 50%;
        }
        50% {
          background-position: 100% 50%;
        }
        100% {
          background-position: 0% 50%;
        }
      }

      .special-title {
        background: linear-gradient(45deg, #ff6b6b, #ffd700);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: pulse 1.5s infinite;
      }

      .remaining-count {
        color: white;
        font-size: 1em;
        margin-top: 15px;
        background: rgba(255, 255, 255, 0.2);
        padding: 10px 20px;
        border-radius: 20px;
        backdrop-filter: blur(10px);
      }

      .reset-btn {
        background: linear-gradient(45deg, #ff6b6b, #ee5a24);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 25px;
        cursor: pointer;
        font-size: 1em;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
      }

      .reset-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 7px 20px rgba(0, 0, 0, 0.3);
      }

      .all-taken {
        background: rgba(255, 255, 255, 0.9);
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        color: #333;
        font-size: 1.5em;
        margin-top: 20px;
      }

      .loading {
        color: white;
        font-size: 1.2em;
        margin-top: 20px;
      }

      .error {
        color: #ff6b6b;
        background: rgba(255, 255, 255, 0.9);
        padding: 20px;
        border-radius: 15px;
        margin-top: 20px;
        font-size: 1.1em;
      }

      @keyframes pulse {
        0% {
          opacity: 1;
        }
        50% {
          opacity: 0.5;
        }
        100% {
          opacity: 1;
        }
      }
    </style>
  </head>
  <body>
    <div class="confetti-container" id="confettiContainer"></div>

    <div class="container">
      <h1 class="title">🎁 Cadeau Mystère 🎁</h1>

      <div class="gift-box" id="giftBox" onclick="openGift()">
        <div class="sparkles" id="sparkles"></div>
        <div class="box-base"></div>
        <div class="ribbon-vertical"></div>
        <div class="ribbon-horizontal"></div>
        <div class="box-lid"></div>
        <div class="bow"></div>
      </div>

      <div class="number-animation" id="numberAnimation"></div>

      <div class="result" id="result">
        <div class="number" id="numberDisplay"></div>
        <div class="message">Votre numéro a été attribué !</div>
        <button class="reset-btn" onclick="closeResult()">Fermer</button>
      </div>

      <div class="click-instruction" id="instruction">
        <div class="loading">🔄 Chargement...</div>
      </div>

      <div class="remaining-count" id="remainingCount" style="display: none">
        Numéros restants: <span id="count">0</span>
      </div>
    </div>

    <script>
      const API_URL = "game.php"; // Remplacez par l'URL de votre API
      let gameData = null;
      let userNumber = null;
      let specialNumbers = [1, 2, 3, 4];

      // Vérifier les paramètres URL pour numéro spécial
      function getSpecialNumber() {
        const urlParams = new URLSearchParams(window.location.search);
        const special = urlParams.get("special");
        if (special && specialNumbers.includes(parseInt(special))) {
          return parseInt(special);
        }
        return null;
      }

      // Générer un ID unique pour ce navigateur/appareil
      function getDeviceId() {
        let deviceId = localStorage.getItem("deviceId");
        if (!deviceId) {
          deviceId =
            "device_" +
            Math.random().toString(36).substr(2, 9) +
            "_" +
            Date.now();
          localStorage.setItem("deviceId", deviceId);
        }
        return deviceId;
      }

      // Initialiser le jeu
      async function initializeGame() {
        try {
          const response = await fetch(API_URL);
          const result = await response.json();

          if (result.success) {
            gameData = result.data;
            updateUI();
          } else {
            showError("Erreur lors du chargement du jeu");
          }
        } catch (error) {
          console.error("Erreur:", error);
          showError("Erreur de connexion au serveur");
        }
      }

      // Mettre à jour l'interface utilisateur
      function updateUI() {
        const deviceId = getDeviceId();
        const specialNumber = getSpecialNumber();
        const instruction = document.getElementById("instruction");
        const remainingCount = document.getElementById("remainingCount");
        const count = document.getElementById("count");

        // Vérifier si cet appareil a déjà un numéro assigné
        if (gameData.deviceAssignments[deviceId]) {
          userNumber = gameData.deviceAssignments[deviceId];
          instruction.innerHTML = `
            <div class="all-taken">
              😊 Votre numéro : <strong>${userNumber}</strong>
              <br><br>
              Chaque personne ne peut tirer qu'une seule fois !
            </div>
          `;
        } else if (specialNumber) {
          // Lien spécial
          if (gameData.availableNumbers.includes(specialNumber)) {
            const title = document.querySelector(".title");
            title.innerHTML = "🌟 Cadeau Mystère Spécial 🌟";
            title.classList.add("special-title");
            instruction.innerHTML = "✨ Votre cadeau spécial vous attend ! ✨";
          } else {
            instruction.innerHTML = `
              <div class="all-taken">
                😔 Le numéro spécial ${specialNumber} a déjà été attribué !
              </div>
            `;
          }
        } else {
          // Numéros normaux (sans les spéciaux)
          const availableNormal = gameData.availableNumbers.filter(
            (n) => !specialNumbers.includes(n)
          );
          if (availableNormal.length > 0) {
            instruction.innerHTML =
              "✨ Cliquez sur la boîte pour découvrir votre numéro ! ✨";
          } else {
            instruction.innerHTML = `
              <div class="all-taken">
                🎉 Tous les numéros ont été attribués ! 🎉
                <br><br>
                <button class="reset-btn" onclick="resetGame()">Recommencer</button>
              </div>
            `;
          }
        }

        // Mettre à jour le compteur
        count.textContent = gameData.availableNumbers.length;
        remainingCount.style.display = "block";

        createSparkles();
      }

      // Créer des étincelles
      function createSparkles() {
        const sparklesContainer = document.getElementById("sparkles");
        sparklesContainer.innerHTML = "";

        for (let i = 0; i < 15; i++) {
          const sparkle = document.createElement("div");
          sparkle.className = "sparkle";
          sparkle.style.left = Math.random() * 100 + "%";
          sparkle.style.top = Math.random() * 100 + "%";
          sparkle.style.animationDelay = Math.random() * 2 + "s";
          sparklesContainer.appendChild(sparkle);
        }
      }

      // Ouvrir le cadeau
      async function openGift() {
        const deviceId = getDeviceId();
        const specialNumber = getSpecialNumber();

        if (gameData.deviceAssignments[deviceId]) {
          showAlreadyUsedMessage();
          return;
        }

        try {
          const response = await fetch(API_URL, {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify({
              deviceId: deviceId,
              specialNumber: specialNumber,
            }),
          });

          const result = await response.json();

          if (result.success) {
            userNumber = result.number;

            // Mettre à jour les données localement
            gameData.availableNumbers = gameData.availableNumbers.filter(
              (n) => n !== userNumber
            );
            gameData.deviceAssignments[deviceId] = userNumber;

            // Animer l'ouverture
            const giftBox = document.getElementById("giftBox");
            giftBox.classList.add("opened");

            createConfetti();

            setTimeout(() => {
              animateNumber(userNumber);
            }, 1000);

            setTimeout(() => {
              showResult(userNumber);
              updateUI();
            }, 4000);
          } else {
            if (result.assignedNumber) {
              // Déjà utilisé
              userNumber = result.assignedNumber;
              showAlreadyUsedMessage();
            } else {
              showError(result.message);
            }
          }
        } catch (error) {
          console.error("Erreur:", error);
          showError("Erreur lors de l'attribution du numéro");
        }
      }

      // Animer le numéro qui sort de la boîte
      function animateNumber(number) {
        const numberAnimation = document.getElementById("numberAnimation");
        numberAnimation.textContent = number;

        if (specialNumbers.includes(number)) {
          numberAnimation.classList.add("special-number");
          setTimeout(() => createConfetti(), 500);
          setTimeout(() => createConfetti(), 1000);
        }

        numberAnimation.classList.add("show");

        setTimeout(() => {
          numberAnimation.classList.remove("show");
          numberAnimation.classList.remove("special-number");
        }, 3000);
      }

      // Créer des paillettes
      function createConfetti() {
        const container = document.getElementById("confettiContainer");
        const shapes = ["square", "circle", "triangle", "star"];
        const colors = [
          "#ff6b6b",
          "#4ecdc4",
          "#ffd700",
          "#ff9ff3",
          "#a8e6cf",
          "#ff8b94",
        ];

        for (let i = 0; i < 50; i++) {
          const confetti = document.createElement("div");
          confetti.className = `confetti ${
            shapes[Math.floor(Math.random() * shapes.length)]
          }`;
          confetti.style.left = Math.random() * 100 + "%";
          confetti.style.animationDuration = Math.random() * 3 + 2 + "s";
          confetti.style.animationDelay = Math.random() * 2 + "s";
          confetti.style.animation = `confetti-fall ${
            Math.random() * 3 + 2
          }s linear infinite`;

          if (
            confetti.classList.contains("square") ||
            confetti.classList.contains("circle")
          ) {
            confetti.style.backgroundColor =
              colors[Math.floor(Math.random() * colors.length)];
          }

          container.appendChild(confetti);
        }

        setTimeout(() => {
          container.innerHTML = "";
        }, 6000);
      }

      // Afficher le résultat
      function showResult(number) {
        const result = document.getElementById("result");
        const numberDisplay = document.getElementById("numberDisplay");
        const instruction = document.getElementById("instruction");
        const message = result.querySelector(".message");

        numberDisplay.textContent = number;

        if (specialNumbers.includes(number)) {
          numberDisplay.classList.add("special-number");
          message.textContent = "🎉 Numéro spécial attribué ! 🎉";
        } else {
          message.textContent = "Votre numéro a été attribué !";
        }

        result.classList.add("show");
        instruction.style.opacity = "0";
      }

      // Fermer le résultat
      function closeResult() {
        const result = document.getElementById("result");
        const giftBox = document.getElementById("giftBox");
        const instruction = document.getElementById("instruction");

        result.classList.remove("show");
        giftBox.classList.remove("opened");
        instruction.style.opacity = "1";

        updateUI();
      }

      // Afficher message d'erreur
      function showError(message) {
        const instruction = document.getElementById("instruction");
        instruction.innerHTML = `<div class="error">${message}</div>`;
      }

      // Afficher le message "déjà utilisé"
      function showAlreadyUsedMessage() {
        const instruction = document.getElementById("instruction");
        instruction.innerHTML = `
          <div class="all-taken">
            😊 Vous avez déjà votre numéro : <strong>${userNumber}</strong>
            <br><br>
            Chaque personne ne peut tirer qu'une seule fois !
          </div>
        `;
      }

      // Remettre à zéro le jeu (admin)
      async function resetGame() {
        const password = prompt("Mot de passe administrateur:");
        if (!password) return;

        try {
          const response = await fetch(API_URL, {
            method: "DELETE",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify({
              password: password,
            }),
          });

          const result = await response.json();

          if (result.success) {
            localStorage.clear();
            location.reload();
          } else {
            alert(result.message);
          }
        } catch (error) {
          console.error("Erreur:", error);
          showError("Erreur lors de la réinitialisation");
        }
      }

      // Initialiser au chargement
      window.onload = function () {
        initializeGame();
      };
    </script>
  </body>
</html>
