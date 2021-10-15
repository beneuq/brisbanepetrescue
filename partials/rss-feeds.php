<?php const RSS_ITEMS_TO_DISPLAY = 5; ?>

<section class="pg-section-fit-content container">
    <h1 class="main-purple-txt center-txt margin-top-1 margin-bottom-1">Some Pet Care Articles from our Partners</h1>
    
    <div id="rss-feeds">
        <div class="rss-feed rss-left">
            <script src="//rss.bloople.net/?url=https%3A%2F%2Fwww.doggroomingcoursesonline.com%2Fblog%2Ffeed%2F&detail=100&limit=<?php echo RSS_ITEMS_TO_DISPLAY ?>&showicon=false&type=js"></script>
        </div>
        <div class="rss-feed rss-right">
            <script src="//rss.bloople.net/?url=https%3A%2F%2Fwww.dogingtonpost.com%2Ftopics%2Ftraining%2Ffeed%2F&detail=100&limit=<?php echo RSS_ITEMS_TO_DISPLAY ?>&showicon=true&type=js"></script>
        </div>
    </div>
    
    <div class="clearfix"></div>
</section>