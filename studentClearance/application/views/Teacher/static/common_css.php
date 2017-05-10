<style type="text/css">
    .chk{
        border:thin solid blue;
    }
    
    .background{
        background-image: url('<?= base_url($scPic); ?>');
        background-repeat: no-repeat; 
/*             background-size: cover;
         */
         background-size: 100px; /*150*/
/*             background-position: center;
     */
        background-position: top-left;
        margin: 5px;       
    }

    .strpRow:hover{
        background-color: #E9BFC3;
        cursor: pointer;
    }

    .btn-danger{
        padding: 5px !important;
    }

    .hideIt{
        display: none;
    }

    .right-side{
        margin-left: 0 !important; 
    }

    td{
        text-transform: uppercase !important;
    }

    .displayLine{
        display: inline;
    }
</style>