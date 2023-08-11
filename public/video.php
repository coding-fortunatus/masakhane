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
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/fjOdtSu4Lm4" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
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



    <script>
        let listVideo = document.querySelectorAll('.video-list .vid');
        let mainVideo = document.querySelector('.main-video video');
        let title = document.querySelector('.main-video .title');
        let desc = document.querySelector('.main-video .desc');

        listVideo.forEach(video => {
            video.onclick = () =>{
                listVideo.forEach(vid => vid.classList.remove('active'));
                video.classList.add('active');
                if(video.classList.contains('active'))
                {
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