<?php require_once '../admin/includes/dbh.php'; ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masakhane</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap                                                     .min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="./css/style_.css">
</head>

<body>
    <nav class="navbar sticky-top navbar-expand-lg bg-light navbar-light" style="background-color: #f2f0e9;">
        <div class="container">
            <a href="#" class="navbar-brand"><img src="images/masa.png" style="width: 50px; height: 50px;" alt=""></a>
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#myNav"><span
                    class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="myNav">
                <ul class="navbar-nav ms-auto">

                    <li class="nav-item"><a href="index.php" class="nav-link">Team</a></li>
                    <li class="nav-item"><a href="video.php" class="nav-link">Gallery</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <h3 class="heading">Video Gallery</h3>
    <div class="contain">
        <?php
                    $query = "SELECT * FROM videos WHERE id =1";
                    $get_videos = mysqli_query($conn, $query);
                    while($row = mysqli_fetch_assoc($get_videos))
                    {
                        $video_title = $row['video_title'];
                        $description = $row['description'];
                        $video_link = $row['video_link'];
                    }

            ?>

        <div class="main-video">
            <div class="video">
                <!-- <iframe src="v1.mp4" width="100%" height="500vh" style="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe> -->
                <iframe width="100%" height="500vh" src="<?php echo $video_link; ?>" title="YouTube video player"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen></iframe>
                <h3 class="title"><?php echo $video_title; ?></h3>
                <p class="desc"><?php echo $description; ?></p>

            </div>
        </div>

        <div class="video-list">
            <?php
                    $query = "SELECT * FROM videos";
                    $get_videos = mysqli_query($conn, $query);
                    while($row = mysqli_fetch_assoc($get_videos))
                    {
                        $video_title = $row['video_title'];
                        $description = $row['description'];
                        $video_link = $row['video_link'];
               ?>
            <div class="vid active">
                <!-- <video src="video/<?php // echo $video_link; ?>" muted></video> -->
                <iframe src="<?php echo $video_link; ?>" title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen></iframe>
                <h3 class="title"><?php echo $video_title; ?></h3>
                <p class="desc"><?php echo $description; ?></p>
            </div>
            <div class="vid active">
                <!-- <video src="video/<?php // echo $video_link; ?>" muted></video> -->
                <iframe src="<?php echo $video_link; ?>" title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen></iframe>
                <h3 class="title"><?php echo $video_title; ?></h3>
                <p class="desc"><?php echo $description; ?></p>
            </div>


            <?php   }

?>

        </div>
    </div>


    <script>
    let listVideo = document.querySelectorAll('.video-list .vid');
    let mainVideo = document.querySelector('.main-video iframe');
    let title = document.querySelector('.main-video .title');
    let desc = document.querySelector('.main-video .desc');

    listVideo.forEach(video => {
        video.onclick = () => {
            listVideo.forEach(vid => vid.classList.remove('active'));
            video.classList.add('active');
            if (video.classList.contains('active')) {
                let src = video.children[0].getAttribute('src');
                mainVideo.src = src;
                let text = video.children[1].innerHTML;
                title.innerHTML = text;
                let des = video.children[2].innerHTML;
                desc.innerHTML = des;
            }
        }
    });
    </script>


</body>

</html>