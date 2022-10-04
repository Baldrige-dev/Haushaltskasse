<?php require_once 'includes/main.inc.php'; ?>

<style>
    html {
        background-image: url("img/background.jpg");

    }

    .background-overlay  {
        top: 0;
        left: 0;
        height: 100vh;
        width: 80%;
        margin: 0px auto;
        background-color: rgba(0, 0, 0, 0.5);
    }

    body {
        text-align: center;
    }

    .main-headline {
        width: 30%;
    }

    button {
        padding: 10px;
        border-style: solid;
        border-color: dimgray;
        border-radius: 15px;
        background-color: cornsilk;
        color: black;
        font-size: 30px;
    }

    button:hover {
        background-color: white;
        opacity: 0.8;
    }

    .btn-vorlagen {
        background-color: powderblue;
    }

    .btn-auswertung {
        background-color: powderblue;
    }

    .btn-plus {
        background-color: powderblue;
    }

    .btn-filter {
        padding: 2px;
        font-size: 15px;
        border-radius: 5px;
        background-color: powderblue;
    }

    .tbl-btn {
        background-color: dimgrey;
        border-style: none;
        border-radius: 0px;
        width: 100%;
    }

    .searchInput {
        border-radius: 15px;
        width: 65%;
        height: 30px;
        background-color: azure;
        text-align: center;
    }

    table {
        width: 95%;
        font-size: 20px;
        margin: 0px auto;
        border-style: solid;
        border-color: dimgray;
        border-radius: 10px;
        background-color: lightgrey;
        color: black;
    }

    tr:hover {
        background-color: lightblue !important;
    }

    div {
        opacity: 99%;
        margin: 0px auto;
        background-color: beige;
        border-style: solid;
        border-color: white;
        border-radius: 30px;
        padding: 2px;
    }

    .div-main {
        width: 60%;
    }

    .div-footer {
        position: absolute;
        left: 35%;
        bottom: 0;
        width: 30%;
        margin-top: auto;
    }

    .modal {
        display: none;
        position: fixed;
        border-radius: 30px;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0,0,0);
        background-color: rgba(0,0,0,0.4);
        padding-top: 60px;
    }

    .modal-content {
        border-radius: 30px;
        background-color: rgba(0, 0, 0, 0.5);
        margin: 5% auto 15% auto;
        border: 1px solid #888;
        width: 60%;
    }

    .div-modal {
        width: 95%;
        font-size: 20px;
        padding: 20px;
    }

    .pie-chart1 {
        background: radial-gradient(circle closest-side, transparent 100%, beige), conic-gradient(
                from 180deg,
                hotpink 0%,
                hotpink <?php echo $controller->auswertungData[0][1][0]?>%,
                steelblue <?php echo $controller->auswertungData[0][1][0]?>%,
                steelblue <?php echo $controller->auswertungData[0][1][1]?>%,
                greenyellow <?php echo $controller->auswertungData[0][1][1]?>%,
                greenyellow <?php echo $controller->auswertungData[0][1][2]?>%,
                orange <?php echo $controller->auswertungData[0][1][2]?>%,
                orange <?php echo $controller->auswertungData[0][1][3]?>%,
                powderblue <?php echo $controller->auswertungData[0][1][3]?>%,
                powderblue <?php echo $controller->auswertungData[0][1][4]?>%,
                tan <?php echo $controller->auswertungData[0][1][4]?>%,
                tan <?php echo $controller->auswertungData[0][1][5]?>%,
                silver <?php echo $controller->auswertungData[0][1][5]?>%,
                silver <?php echo $controller->auswertungData[0][1][6]?>%,
                aquamarine <?php echo $controller->auswertungData[0][1][6]?>%,
                aquamarine <?php echo $controller->auswertungData[0][1][7]?>%,
                royalblue <?php echo $controller->auswertungData[0][1][7]?>%,
                royalblue 100%
        );
        min-width: 300px;
        min-height: 450px;
        width: 45%;
        float: left;
        padding: 20px;
    }

    pie-chart2 {
        background: radial-gradient(circle closest-side, transparent 100%, beige), conic-gradient(
                from 180deg,
                hotpink 0,
                hotpink 11%,
                steelblue 0,
                steelblue 22%,
                greenyellow 0,
                greenyellow 33%,
                orange 0,
                orange 44%,
                powderblue 0,
                powderblue 55%,
                tan 0,
                tan 66%,
                silver 0,
                silver 77%,
                aquamarine 0,
                aquamarine 88%,
                royalblue 0,
                royalblue 100%
        );
        min-width: 300px;
        min-height: 450px;
        width: 45%;
        float: left;
        padding: 20px;
    }

    .div-leg {
        width: 45%;
        float: left;
        padding: 20px;
    }
</style>
