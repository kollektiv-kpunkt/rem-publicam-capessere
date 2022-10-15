<?php
get_header( );
$afconfig = json_decode(file_get_contents(get_template_directory(  ) . $_ENV["AFconfig"]), true);
$formid = uniqid();
?>

<div class="SmallContainerInner">
    <div id="actionformPlayground" class="mt-32">
        <h1 class="mb-12 text-4xl p-4 bg-red-600 text-white text-center">Actionform Playground:<br>NOT LIVE</h1>
        <?php
        get_template_part("blocks/block-actionform-2.0");
        ?>
    </div>
    <div id="currentFormdata" class="p-4 bg-black text-white mt-16" hidden>
        Sent Formdata:
        <span id="currentFormdata-content" class="block">{}</span>
    </div>
</div>


<style>
    .rpc-actionform-form {
        --form-color: black;
    }

    .rpc-actionform-step + .rpc-actionform-step {
        margin-top: 5rem;
    }

    #actionformPlayground h2.text-white, #actionformPlayground p.text-white {
        color: black;
    }

    #actionformPlayground .rpc-button.rpc-button-neg {
        --backgroundcolor: black;
    }

    /* #actionformPlayground .rpc-actionform-step[hidden] {
        display: block;
    } */

    #actionformPlayground .share-buttons a.rpc-button.rpc-button-neg.rpc-button-line {
        color: black !important
    }

    .NavbarWrapper > .scrollbar  {
        background-color: var(--prim);
    }

    html {
        background-color: #ffff00;
    }
</style>

<?php
get_footer( );
?>