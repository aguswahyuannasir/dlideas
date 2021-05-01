<style type="text/css">
    .error{
        text-align: center;
        border:1px solid black;
        background-color: #ddd;
        width: 50%;
        margin-left: 25%;
        margin-top: 10%;
    }
    .background{
        background: black;
    }
    .error_404{
        font-size: 50px;
        margin: 0px;
    }
</style>
<html>
    <body class="background">
        <div class="error">
            <h1 class="error_404"> Error 404 </h1>
            <hr>
            <h3 style="color:green;">File Not Found</h3>
            <div>Please Click Link Below For Back To Aplication !</div>
            <br>
            <div> 
                <a href="<?= site_url()?>"><h3>Return To Application</h3></a>
            </div>
            <br>
        </div>
    </body>
</html>