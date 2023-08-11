<?php require_once './include/header.php'; ?>
    <h3 class="heading">Video Gallery</h3>
        <div class="contain">
            <div class="main-video">
                <div class="video">
                    <?php 
                        $query = "SELECT * FROM videos WHERE id = 1";
                        $get_videos = mysqli_query($conn, $query);
                        while($row = mysqli_fetch_assoc($get_videos))
                        {
                            $video_title = $row['video_title'];
                            $description = $row['description'];
                            $video_link = $row['video_link'];

                    ?>
                    <video src="video/v1.mp4" controls muted autoplay></video>
                    <h3 class="title"><?php echo $video_title; ?></h3>
                    <p class="desc"><?php echo $description; ?></p>
                </div>
                <?php
                        }
                        ?>
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
                    <video src="video/<?php echo $video_link; ?>" muted></video>
                        <h3 class="title"><?php echo $video_title; ?></h3>
                        <p class="desc"><?php echo $description; ?></p>
                </div>


         <?php   }

?>
                
            </div>
        </div>



    <script src="js/bootstrap.min.js"></script>
    <script src="js/sweetalert2.all.js"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/script.js"></script>
    
    
</body>
</html>