<?php

session_start();

if (isset($_POST['formconnexion'])) {
    $mdpconnect = $_POST['mdpconnect'];

    if ($mdpconnect == 478935) {
        $erreur = "YOU RIGHT <br /> <a href=\"test.php\" class=\"link\" style=\"text-decoration: none; padding-left: 55px;\">GO</a>";
    } else {
        $erreur = "YOU WRONG";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hacked Game</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<script src="js/three.js"></script>
<script src="js/OBJLoader.js"></script>

<div class="container">
    <div class="row">
        <form class="form-signin col-md-6 offset-md-3 pt-3" method="POST" action="index.php">
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" name="mdpconnect" id="inputPassword" class="form-control" placeholder="Password"
                   required><br>
            <button class="btn btn-lg btn-danger btn-block" name="formconnexion" type="submit">Login</button>
        </form>
    </div>
    <br>
    <?php
    if (isset($erreur)) {
        echo '<h4 class="col-md-2 offset-md-5">' . $erreur . "</h4>";
    }
    ?>

</div>

<script>
    var container;
    var camera, scene, renderer;
    var mouseX = 0, mouseY = 0;
    var windowHalfX = window.innerWidth / 2;
    var windowHalfX = window.innerWidth / 2;
    var windowHalfY = window.innerHeight / 2;
    var object;
    init();
    animate();

    function init() {
        container = document.createElement('div');
        document.body.appendChild(container);
        camera = new THREE.PerspectiveCamera(45, window.innerWidth / window.innerHeight, 1, 2000);
        camera.position.z = 30;
        // scene
        scene = new THREE.Scene();
        var ambientLight = new THREE.AmbientLight(0xcccccc, 0.4);
        scene.add(ambientLight);
        var pointLight = new THREE.PointLight(0xffffff, 0.8);
        camera.add(pointLight);
        scene.add(camera);

        // manager
        function loadModel() {
            object.traverse(function (child) {
                if (child.isMesh) child.material.map = texture;
            });
            object.position.y = -5;
            scene.add(object);
        }

        var manager = new THREE.LoadingManager(loadModel);
        manager.onProgress = function (item, loaded, total) {
            console.log(item, loaded, total);
        };
        // texture
        var textureLoader = new THREE.TextureLoader(manager);
        var texture = textureLoader.load('textures/code.png');

        // model
        function onProgress(xhr) {
            if (xhr.lengthComputable) {
                var percentComplete = xhr.loaded / xhr.total * 100;
                console.log('model ' + Math.round(percentComplete, 2) + '% downloaded');
            }
        }

        function onError(xhr) {
        }

        var loader = new THREE.OBJLoader(manager);
        loader.load('obj/casse-tete-final.obj', function (obj) {
            object = obj;
        }, onProgress, onError);
        //
        renderer = new THREE.WebGLRenderer();
        renderer.setPixelRatio(window.devicePixelRatio);
        renderer.setSize(window.innerWidth, window.innerHeight);
        container.appendChild(renderer.domElement);
        document.addEventListener('mousemove', onDocumentMouseMove, false);
        //
        window.addEventListener('resize', onWindowResize, false);
    }

    function onWindowResize() {
        windowHalfX = window.innerWidth / 2;
        windowHalfY = window.innerHeight / 2;
        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(window.innerWidth, window.innerHeight);
    }

    function onDocumentMouseMove(event) {
        mouseX = (event.clientX - windowHalfX) / 10;
        mouseY = (event.clientY - windowHalfY) / 10;
    }

    //
    function animate() {
        requestAnimationFrame(animate);
        render();
    }

    function render() {
        camera.position.x += (mouseX - camera.position.x) * .05;
        camera.position.y += (-mouseY - camera.position.y) * .05;
        camera.lookAt(scene.position);
        renderer.render(scene, camera);
    }
</script>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
</body>
</html>