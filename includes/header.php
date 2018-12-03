<?php require_once("includes/config.php"); ?>

<!DOCTYPE html>

<html>
<head>
    <title>Moving Pictures</title>
    <!-- Bootstrap CDN should go before local CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel = "stylesheet" type="text/css" href = "assets/css/style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src = "assets/js/commonActions.js"></script>
</head>

<body>
    <!-- the div that will encapsulate the entire page -->
    <div id = "pageContainer">
        <!-- Going for that youtube look -->
        <div id = "mastHeadContainer">
            <button class = "showHideSideBar">
                <img src = "assets/images/icons/menu.png">
            </button>

            <!-- Logo -->
            <a class = "logoContainer" href="index.php">
                <!-- Title and alt are good practices because title shows when we hover and alt will show up if there are problems -->
                <img src = "assets/images/icons/logo.png" title = "Platnium Player" alt="Site Logo">
            </a>

            <div class = "searchBarContainer">
                <!-- Data in this form will be sent to the action -->
                <form action = "search.php" method = "GET">
                    <input type = "text" class = "searchBar" name = "term" placeholder="Search here...">
                    <button class = "searchButton">
                        <img src = "assets/images/icons/search.png" title = "Type to search" alt="Search button">
                    </button>
                </form>

            </div>

            <div class = "rightIcons">
                <a href="upload.php">
                    <img class = "upload" src = "assets/images/icons/upload.png" title = "Upload file" alt="UPLOAD">
                </a>
                <!-- Whether user is signed in or not, the anchor tag will give a different result based on state -->
                <a href="#">
                    <img class = "profile" src = "assets/images/icons/profileUser.png" title = "Sign In/Profile" alt="USER">
                </a>
            </div>
        </div>
        <!-- Side navigation menu on left -->
        <div id = "sideNavContainer" style="display:none;">
        
        </div>
        <!-- Where the content will appear -->
        <div id = "mainSectionContainer">
            <div id = "mainContentContainer">