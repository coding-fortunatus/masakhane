<?php require_once "./include/header.php"; ?>
<div class="bg-light text-dark p-5 text-center h1" id="nav">
    <h3 class="title" style="font-size: 3rem;">Masakhane Community</h3>
</div>
<div class="contain m-10">
    <div class="row g-3 m-3">
    </div>
</div>
<div class="container m-10" style="background-color: transparent!important;">
    <div class="row g-3 m-3">
        <?php
            $query = "SELECT * FROM members LIMIT 24";
            $get_data = mysqli_query($conn, $query);
            while($row = mysqli_fetch_assoc($get_data))
            {
                $id = $row['id'];
                $fullname = $row['fullname'];
                $affiliation = $row['affiliation'];
                $nationality = $row['nationality'];
                $languages_spoken = $row['languages_spoken'];
                $languages_working_on = $row['languages_working_on'];
                $country_interesting = $row['country_interesting'];
                $nlp_ml_tasks = $row['nlp_ml_tasks'];
                $images = $row['images']; ?>
        <div class="col-sm-6 col-lg-3 col-md-4">
            <div class="card" style="border-style: hidden;">
                <div class="card-body text-center">
                    <img data-bs-toggle="modal" data-bs-target="#det1<?php echo $id; ?>" src="<?php echo $images; ?>"
                        alt="" class="rounded-circle mb-3">
                    <h3 class="card-title mb-1"></h3>
                    <p><i><?php echo $fullname; ?></i></p>
                    <?php
                if ($affiliation == "" || $nationality == "" || $languages_spoken == "" || $languages_working_on == "" || $country_interesting == "" || $nlp_ml_tasks == "") {
                }
                else 
                {
                ?>
                    <!-- Modals -->
                    <div class="modal fade" id="det1<?php echo $id; ?>">
                        <div class="modal-dialog">
                            <div class="modal-content ">
                                <div class="modal-body">
                                    <a href="#" class="btn btn-close" data-bs-dismiss="modal"></a>
                                    <div class="details">
                                        <img class="center rounded-circle" src="<?php echo $images; ?>" alt="">
                                    </div>
                                    <div class="cent">
                                        <p class="name">
                                            <strong><?php echo $fullname; ?></strong><br><?php echo $nlp_ml_tasks; ?>
                                        </p>
                                        <hr>
                                    </div>
                                    <section style="padding-left: 20px;">
                                        <p><strong>Nationality:</strong> <?php echo $nationality; ?></p>
                                        <p><strong>Affiliation:</strong> <?php echo $affiliation; ?></p>
                                        <p><strong>Language(s) spoken:</strong> <?php echo $languages_spoken; ?></p>
                                        <p><strong>Language(s) working on:</strong> <?php echo $languages_working_on; ?>
                                        </p>
                                        <p><strong>Country Points Of Interest:</strong>
                                            <?php echo $country_interesting; ?></p>
                                    </section>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End of Modal -->
                    <?php             
                }
                ?>
                </div>
            </div>
        </div>
        <?php
            }
            ?>
    </div>
</div>
<script src="js/sweetalert2.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-3.6.0.min.js"></script>
<script src="js/all.min.js"></script>
<script type="text/javascript">
// let scrolldelay;
// const autoScroll = () => {
//     window.scrollBy(0, 10);
//     let scrolldelay = setTimeout(autoScroll, 20)
// }
let scrollerID;
let paused = true;
let interval = 20;

function startScroll() {
    let id = setInterval(function() {
        window.scrollBy(0, 10);
        if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
            // end of page?
            stopScroll();
        }
    }, interval);
    return id;
}

function stopScroll() {
    clearInterval(scrollerID);
}


const timeoutInMiliseconds = 5000;
let timeoutId;

function startTimer() {
    // window.setTimeout returns an Id that can be used to start and stop a timer
    timeoutId = window.setTimeout(doInactive, timeoutInMiliseconds)
}

function resetTimer() {
    stopScroll()
    paused = true
    window.clearTimeout(timeoutId)
    startTimer();
}

function doInactive() {
    scrollerID = startScroll()
    paused = false
}

function setupTimers() {
    document.addEventListener("mousemove", resetTimer, false);
    document.addEventListener("mousedown", resetTimer, false);
    document.addEventListener("keypress", resetTimer, false);
    document.addEventListener("touchmove", resetTimer, false);

    startTimer();
}


setupTimers()

// autoScroll();
</script>
</body>

</html>