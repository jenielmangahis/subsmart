<style>
    ul.jobTags {
        list-style: none;
        padding-left: 0;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: center;
        line-height: 2.5rem;
    }

    ul.jobTags a {
        /*color: #a33;*/
        display: block;
        font-size: 15px;
        padding: 0px 5px;
        text-decoration: none;
        position: relative;
        border: 1px solid;
        margin:3px;
        border-radius: 10px;
/*        --size: attr(data-weight number, 2); 
        font-size: calc(var(--size) * 10px);*/
    }


</style>

<ul class="jobTags">
    <?php foreach ($tags as $t): ?>
        <li><a class="tagsData" href="#"><?= $t->name; ?> (0) </a></li>
    <?php endforeach; ?>
</ul>

