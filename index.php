<html>

<head>
    <title>Read GIPHY APi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!--Bootstrap 5 cdn-->
</head>
<body>
    <?php
session_start();
error_reporting(0); //remove error logs
//post vars
$trending = $_POST['trending'] ;
if(!$trending) {
    $category = $_POST['category'];
    $search_term = $_POST['search'];
}
$get_rating = $_POST['rating'];
$get_amount = $_POST['amount'];
//session vars
$_SESSION['amount'] = $get_amount;
$_SESSION['search_term'] = $search_term;
$_SESSION['category'] = $category;
$_SESSION['rating'] = $get_rating;

//global vars
global $get_amount;
global $get_rating;
global $trending;
global $category;
global $selected;
//build the query 
if($trending || $category  == 'trending') { //if trending cat checked
    $get_value = strtolower($trending);
    $url = 'https://api.giphy.com/v1/gifs/'. $get_value .'?api_key=7FnUSmAPsyByHMPmHTIs5Ig9LvuFoJst&limit='. $get_amount.'&rating='.$get_rating;
}
elseif($category) {

    $get_value = strtolower($category);
    $url = 'https://api.giphy.com/v1/gifs/search?q=' . $get_value . '&api_key=7FnUSmAPsyByHMPmHTIs5Ig9LvuFoJst&limit='. $get_amount .'&rating='.$get_rating.'<br>';

} elseif ($search_term) {
    $get_value = strtolower($search_term);
    $url = 'https://api.giphy.com/v1/gifs/search?q=' . $get_value . '&api_key=7FnUSmAPsyByHMPmHTIs5Ig9LvuFoJst&limit='. $get_amount .'&rating='.$get_rating.'<br>';

} else{
    $get_value = "random";
    $url = 'https://api.giphy.com/v1/gifs/search?q=' . $get_value . '&api_key=7FnUSmAPsyByHMPmHTIs5Ig9LvuFoJst&limit='. $get_amount .'&rating='.$get_rating.'<br>';

}
if(!$_POST['amount']) {
   $_POST['amount'] == 25; //limit of return gifs
}
if(!$_POST['rating']) {
    $_POST['rating'] == 'g';//gifphy rating
}
?>
    <style>
        input#search,
        input#search:focus-visible {
            border: 0 !important;
        }
        .form-check {
            font-weight: 600;
        }
    </style>
    <div style="width: 100%;background-color: #d5ffff;padding:25px;">
        <form class="container" id="gifForm" action="http://localhost/gifapiphp/index.php" method="post"
            style="background-color: #d5ffff;">
            <div style="width: 100%;height:50px;background-color: #fff;margin-bottom: 5px;">
                <img src="https://icons.nic-edesign.com/search-grey.png"
                    style="width:25px;float:left;margin-left: 10px;margin-top: 10px;">
                <input id="search"
                    style="box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.2)width:90%;float:left;height:50px;border-top-right-radius: 0!important;border-bottom-right-radius: 0!important"
                    class="form-control-lg" placeholder="search for GIFs" type="search" name="category"
                    value="<?php echo $_SESSION['category'] ?>">
                <!--search input-->
            </div>
            <div class="container" style="background-color: #fff;padding:5px;margin-bottom: 5px;">
                <div class="row" style="padding-left: 30px;">
                    <div class="col form-check" >
                        <!--category radio buttons-->
                        <label class="form-check-label" for="trending">Trending</label>
                        <input class="form-check-input" type="radio" id="trending" name="trending" value="Trending">
                    </div>
                    <div class="col form-check" style="padding:5px;padding-left: 15px;border-radius: 5px;">
                        <label class="form-check-label" for="sports">Sports</label>
                        <input class="form-check-input" type="radio" id="sports" name="category" value="Sports">
                    </div>
                    <div class="col form-check" style="padding:5px;border-radius: 5px;">
                        <label class="form-check-label" for="entertainment">Entertainment</label>
                        <input class="form-check-input" type="radio" id="entertainment" name="category"
                            value="Entertainment">
                    </div>
                    <div class="col form-check" style="padding:5px;border-radius: 5px;" >
                        <label class="form-check-label" for="reactions">Reactions</label>
                        <input class="form-check-input" type="radio" id="reactions" name="category" value="Reactions">
                    </div>
                    <div class="col form-check" style="padding:5px;border-radius: 5px;">
                        <label class="form-check-label" for="stickers">Stickers</label>
                        <input class="form-check-input" type="radio" id="stickers" name="category" value="Stickers">
                    </div>
                    <div class="col form-check" style="padding:5px;border-radius: 5px;">
                        <label class="form-check-label" for="artists">Artists</label>
                        <input class="form-check-input" type="radio" id="artists" name="category" value="Artists">
                    </div>
                    <div class="col form-check" style="padding:5px;border-radius: 5px;">
                        <label class="form-check-label" for="alcohol">Alcohol</label>
                        <input class="form-check-input" type="radio" id="alcohol" name="category" value="Alcohol">
                    </div>
                </div>
            </div>
            <select style="box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.2)width:150px;float:left;margin-right: 10px;"
                class="form-select" name="amount" id="gifamount" aria-label="Select an amount">
                <!--return amount select list-->
                <?php if($_POST['amount']) {?>
                <option><?php echo $_POST['amount']; ?></option>
                <?php } else {?>
                <option value="25">choose amount</option>
                <?php } ?>
                <option selected value="25">25</option>
                <option value="50">50</option>
                <option value="75">75</option>
            </select>
            <select style="width:150px;float:left;margin-right: 10px;box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.2)"
                class="form-select" name="rating" id="rating" aria-label="Select a rating">
                <?php if($_POST['rating']) { ?>
                <option><?php echo $_POST['rating'] ?></option>
                <!--giphy age restriction-->
                <?php } else { ?>
                <option value="g">choose rating</option>
                <?php }?>
                <option value="g">g</option>
                <option value="pg">pg</option>
                <option value="pg-13">pg-13</option>
                <option value="r">r</option>
            </select>

            <input class="btn btn-primary"
                style="box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.2);background-color: white;color: #5429ff;font-weight: 600;border: 0px!important;"
                type="submit" value="Get GIFs">
            <!--search button-->
        </form>
        <form class="container" action="clear.php" method="post">
            <input type="hidden" name="destroy" value="1">
            <input class="btn btn-danger" type="submit" value="Clear">
        </form><!--clear terms-->
    </div>
    <div style="width: 100%;background-color: #d5ffff;padding: 10px;padding-top:0px;">
        <div class="container" style="padding:5px;">
            <h5 style="background-color:#fff;padding: 5px;display: inline-block">Showing <?php echo $_POST['amount'] ?>
                <strong>"<?php echo strtoupper($get_value) ?>"</strong> GIFs rated
                <strong>"<?php echo strtolower($_POST['rating']) ?>"</strong></h5>
            <!--returning current gif cats-->
        </div>
    </div>
    <div class="container-fluid" style="padding-left: 5%;padding-right: 5%;">
        <div class="row">
            <?php
if($get_value) {
    $array = json_decode(file_get_contents($url),true);
//return results - gifs
    foreach ($array as $rec) {
       foreach ($rec as $rord) {
           $id = $rord["id"];
           ?>
            <div class="col-lg-2 text-center"><!--gif containers-->
                <div
                    style="width:90%;min-height:15em;background-repeat: no-repeat;background-image: url('https://media.giphy.com/media/<?php echo $id ?>/200.gif');">
                </div>
            </div>
            <?php
       }
    }
}
?>
        </div>
    </div>
</body>
<div class="container-fluid" style="height: 10em;background-color: #d5ffff;">
    <!--footer container-->
    <div class="row">
        <div class="col-lg-4 text-center"><!--first image in footer-->
            <img width="200" style="padding-top: 1em;" class="hire"
                src="https://media4.giphy.com/media/MbhTDqkrbROYv3izOv/giphy.gif?cid=ecf05e47jvx2akfjoaimoxzjk72is4hnsw2rrbx4yrsul619&rid=giphy.gif&ct=s">
        </div>
        <div class="col-lg-4 text-center">
            <p style="padding-top: 2em;" id="footer-section-2">Powered by <a class="hire"
                    href="https://www.php.net/">PHP</a><br> Developed by Nic Moorhouse</p><!--text in footer-->
        </div>
        <div class="col-lg-4 text-center"><!--second image in footer-->
            <img width="200" style="padding-top: 2em;" class="hire-2"
                src="https://media2.giphy.com/media/eiMn6aBwpkSCffKOG0/giphy.gif?cid=ecf05e47zhha2i8sz0q7arbrwis2yfrmz4o1kxof5ui9fh7w&rid=giphy.gif&ct=g">
        </div>
    </div>
</div>
</html>