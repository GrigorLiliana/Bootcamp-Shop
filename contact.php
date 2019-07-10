<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel='stylesheet' href='styles/style.css'>
</head>

<body>
    <header>
        <?php include_once 'header.php' ?>
    </header>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <h2>Contact Us</h2>
                    <form>
                        <div class="form-group">
                            <label for="firstLastName">Your Name</label>
                            <input type="text" class="form-control" id="firstLastName" placeholder="First and last name">
                        </div>
                        <div class="form-group">
                            <label for="inputEmail">Email address</label>
                            <input type="email" class="form-control" id="emailForm" aria-describedby="emailHelp" placeholder="Enter email">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" class="form-control" id="subjectForm" aria-describedby="subject" placeholder="Enter the subject">
                        </div>
                        <div class="form-group">
                            <label for="subject">Message</label>
                            <input type="text-area" class="form-control" id="messageForm" aria-describedby="message" placeholder="Enter your message">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="col-sm">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d20723.679195981247!2d5.964227931766986!3d49.51359267787724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x479535034c0a600b%3A0xe8b8bed0e26f33a!2sTechnoport+S.a.!5e0!3m2!1sen!2slu!4v1562709310054!5m2!1sen!2slu" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                    <p>Technoport SA, HUB, Belval</p>
                    <p>9 Avenue des Hauts-Fourneaux</p>
                    <p>4362 Esch-sur-Alzette</p>
                </div>
            </div>
        </div>



    </main>
    <footer>
        <?php include_once 'footer.php' ?>
    </footer>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/ff9603d652.js"></script>
</body>

</html>