<?php
/**
 * Created by PhpStorm.
 * User: hasskell
 * Date: 17/02/16
 * Time: 10:21
 */


?>
<style>
    .column {
        width: 250px;
        float: left;
        padding-bottom: 100px;
    }
    .portlet {
        margin: 0 1em 1em 0;
        padding: 0.3em;
    }
    .portlet-header {
        padding: 0.2em 0.3em;
        margin-bottom: 0.5em;
        position: relative;
        color: white;
    }
    .portlet-toggle {
        position: absolute;
        top: 50%;
        right: 0;
        margin-top: -8px;
    }
    .portlet-content {
        padding: 0.4em;
        background-color: black!important;
        color: white;
        opacity:0.9;
    }
    .portlet-placeholder {
        border: 1px dotted black;
        margin: 0 1em 1em 0;
        height: 50px;
    }
</style>
<script>
    $(function() {
        $( ".column" ).sortable({
            connectWith: ".column",
            handle: ".portlet-header",
            cancel: ".portlet-toggle",
            placeholder: "portlet-placeholder ui-corner-all"
        });

        $( ".portlet" )
            .addClass( "ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" )
            .find( ".portlet-header" )
            .addClass( "ui-widget-header ui-corner-all" )
            .prepend( "<span class='ui-icon ui-icon-minusthick portlet-toggle'></span>");

        $( ".portlet-toggle" ).click(function() {
            var icon = $( this );
            icon.toggleClass( "ui-icon-minusthick ui-icon-plusthick" );
            icon.closest( ".portlet" ).find( ".portlet-content" ).toggle();
        });
    });
</script>

<div class="column">

    <div class="portlet">
        <div class="portlet-header">Booking</div>
        <div><img src="/img/garage.jpeg"></div>
        <div class="portlet-content">Description about menu </div>
    </div>

    <div class="portlet">
        <div class="portlet-header">Supplier</div>
        <div><img src="/img/garage.jpeg"></div>
        <div class="portlet-content">Description about menu</div>
    </div>

</div>

<div class="column">

    <div class="portlet">
        <div class="portlet-header">Customer</div>
        <div><img src="/img/garage.jpeg"></div>
        <div class="portlet-content">Description about menu</div>
    </div>
    <div class="portlet">
        <div class="portlet-header">Job commencement</div>
        <div><img src="/img/garage.jpeg"></div>
        <div class="portlet-content">Description about menu</div>
    </div>
</div>

<div class="column">

    <div class="portlet">
        <div class="portlet-header">Job completion</div>
        <div><img src="/img/garage.jpeg"></div>
        <div class="portlet-content">Description about menu</div>
    </div>

    <div class="portlet">
        <div class="portlet-header">Stock</div>
        <div><img src="/img/garage.jpeg"></div>
        <div class="portlet-content">Description about menu</div>
    </div>

</div>
