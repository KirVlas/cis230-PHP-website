<?php
$page_title = "Product Details";
require "includes/head.php";
?>
<section id="main_content">
    <div class="top">
        <img src="img/product.jpg" alt="product">
        <div class="top_right"><h3>Product Name</h3>
            <p>This is a description of the product that is for sale at this website. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ipsum risus, feugiat vitae auctor sed, porttitor vel erat. Sed vel nibh a odio vulputate dignissim non sit amet tortor. Curabitur tincidunt eros ornare imperdiet egestas. Quisque mauris magna, molestie porta rutrum at, vestibulum ac sem. In hac habitasse platea dictumst.</p>
            <span>Price: $59.99</span></div>
    </div>
    <div class="bottom">
        <div class="comments">
            <h3>Comments</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ipsum risus, feugiat vitae auctor sed, porttitor vel erat. Sed vel nibh a odio vulputate dignissim non sit amet tortor. Curabitur tincidunt eros ornare imperdiet egestas. Quisque mauris magna, molestie porta rutrum at, vestibulum ac sem. In hac habitasse platea dictumst. Donec est leo, pulvinar ac consectetur non, rhoncus vitae enim. Aenean a sapien tempor, euismod est ac, rhoncus quam. Praesent eget nisl feugiat, dictum massa in, consectetur enim. Suspendisse semper lacus neque, lobortis facilisis nunc pretium vitae. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
        <div class="comments_form">
            <form>
                <label for="name">Name: </label><input type="text" name="name" id="name">
                <label for="rating">Rating: </label><input type="text" name="rating" id="rating" size="5"><br/><br/>
                <textarea rows="5" cols="40" placeholder="Comments"></textarea>
            </form>
        </div>
    </div>
</section>
<?php
require "includes/footer.php";
?>