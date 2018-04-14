<?php
/* Displays user information and some useful messages */
session_start();

// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location: error.php");    
}
else {
    // Makes it easier to read
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
	$active = $_SESSION['active'];
	$client_info = $_SESSION['client_info'];
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Client Side | A Creative Cliche</title>
        <?php include 'css/css.html'; ?>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="user-scalable=0, width=device-width">
        <!--<meta name="viewport" content="width=device-width, initial-scale=1.0, minimal-ui, maximum-scale=1.0;">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">-->
        <meta name="apple-mobile-web-app-capable" content="yes"/>
        <meta name="apple-mobile-web-app-title" content="A Creative Cliche">
        <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
        <!-- web app startup images -->
        <!-- iPad, retina, portrait -->
        
        <!-- Stop safari iOS from resizing text on orientation change -->
        <style>
            -webkit-text-size-adjust: 100%; </style>
       
        <!--[if IE 7]>
	<link rel="stylesheet" type="text/css" href="/css/font-awesome-ie7.css?1421472595" />	<![endif]-->
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

        
        <style>
            html {
                background: url(/img/background_blurred.jpg) no-repeat top right fixed;
                background-size: cover;
            }

            body {
                background: transparent;
            }

            body > .container-fluid {
                padding: 0;
            }

            #main-content-wrap {
                max-width: 1300px;
                margin: 0 auto;
            }

            .tooltip {
                z-index: 99999;
            }

            .table-list-search {
                cursor: pointer;
            }

            .search-query-sf, .search-sf {
                cursor: default;
            }

            .table-list-search .search-query-sf td {
                background: rgba(0, 0, 0, 0) !important;
                padding: 15px !important;
            }

            .loadingPaneWrap, .clientListPaneWrap, .menswearPaneWrap, .catalogListPaneWrap, .earningsPaneWrap, .invoicesPaneWrap {
                margin-left: 100px;
            }

            #invoiceTable_wrapper, #orderTable_wrapper {
                margin-top: 10px;
            }

            #clientTable {
                background: transparent;
                border-top-right-radius: 2px;
                overflow: hidden;
                border-top-left-radius: 2px;
                box-shadow: 0px 4px 3px -3px rgba(0, 0, 0, 0.4);
                margin-top: 10px;
            }

            #clientTable tbody tr td, #catalogTable tbody tr td {
                background: rgba(255, 255, 255, 0.88);
                text-align: center;
            }

            #invoiceTable tbody tr td .cellWrap, #orderTable tbody tr td .cellWrap {
                position: relative;
                background: rgba(255, 255, 255, 0.88);
                margin: 2px 0;
                height: 65px;
            }

            #invoiceTable .smallClientProfilePic {
                float: left;
                margin-right: 10px;
            }

            #invoiceTable .smallClientProfilePic img {
                margin: 0;
                height: 75px;
                width: auto;
                height: 75px;
                margin-top: 0px;
            }

            #invoiceTable tbody td, #orderTable tbody td {
                padding: 0;
                border: none;
            }

            #invoiceTable .invoiceLabel, #orderTable .invoiceLabel {
                font-weight: bold;
                display: inline-block;
                width: 50px;
            }

            #invoiceTable td:first-child, #orderTable td:first-child {
                width: 250px;
            }

            #invoiceTable tbody tr td sup, #orderTable tbody tr td sup {
                font-size: 18px;
            }

            #invoiceTable_wrapper .bottom label, #orderTable_wrapper .bottom label {
                margin-top: 10px;
            }

            @media (max-width: 767px) {
                #invoiceTable tbody tr td .cellWrap, #orderTable tbody tr td .cellWrap {
                    height:160px;
                }

                #invoiceTable tbody tr td sup, #orderTable tbody tr td sup {
                    font-size: 14px;
                    top: 0;
                }

                #invoiceTable tbody tr td sup, #orderTable tbody tr td sup {
                    height: 150px;
                }

                #invoiceTable .invoiceLabel, #orderTable .invoiceLabel {
                    width: 80px;
                }

                #invoiceTable td:first-child, #orderTable td:first-child {
                    width: 100%;
                }
            }

            #clientTable tbody tr.clientRow.notification, #catalogTable tbody tr.catalogRow.notification {
                background: #FFF;
            }

            #invoiceTable tbody tr:hover td .cellWrap, #orderTable tbody tr:hover td .cellWrap, #clientTable tbody tr:hover td, #catalogTable tbody tr:hover td {
                background: #FFF;
            }

            #clientTable tbody tr:hover .btn-ghost-dark {
                background: #4CC397;
                color: white;
                border-color: transparent;
            }

            #clientTable tbody tr:hover .btn-ghost-dark:hover {
                background: #121212;
                color: white;
            }

            #invoiceTable thead th, #orderTable thead th, #clientTable thead th, #catalogTable thead th {
                text-indent: 10px;
                color: #FFF;
                padding: 5px 0 0;
                height: 35px;
                line-height: 35px;
                font-family: 'Medio';
                font-size: 16px;
                text-transform: uppercase;
                letter-spacing: 1px;
                border-bottom: none;
                text-align: center;
            }

            #clientTable thead tr th:hover, #catalogTable thead tr th:hover {
                background: #131313;
            }

            #clientTable thead th.hidden-sm.hidden-xs.no-sort, #clientTable thead tr th.no-sort:hover {
                background-color: transparent;
                cursor: default;
            }

            #clientTable thead th.hidden-sm.hidden-xs.no-sort a {
                cursor: default !important;
            }

            #catalogTable thead th.hidden-sm.hidden-xs.no-sort, #catalogTable thead tr th.no-sort:hover {
                background-color: transparent;
                cursor: default;
            }

            #catalogTable thead th.hidden-sm.hidden-xs.no-sort a {
                cursor: default !important;
            }

            #clientTable thead th, #clientTable thead th span, #catalogTable thead th, #catalogTable thead th span {
                color: #FFF;
                text-decoration: none;
                font-weight: normal;
            }

            #clientTable thead th span, #catalogTable thead th span {
                display: block;
            }

            #clientTable thead th span i.fa, #catalogTable thead th span i.fa {
                font-size: 17px;
                padding: 0;
                position: relative;
                left: -10px;
                float: right;
                margin-top: 6px;
                color: transparent;
            }

            #clientTable thead th:hover span i.fa, #catalogTable thead th:hover span i.fa {
                color: white;
            }

            #clientTable .featureVisibility .badge.notification, #catalogTable .featureVisibility .badge.notification {
                font-size: 11px;
                top: -8px;
                left: inherit;
                right: -4px;
                height: 18px;
                line-height: 18px;
                width: auto;
                border-radius: 3px;
                box-shadow: none;
            }

            .clientSearchResultWrap {
                margin-bottom: 3px;
                border: none;
                border-left: 6px solid #696969;
                cursor: pointer;
            }

            .clientSearchResultWrap:hover {
                border-left: 6px solid #525252;
                background: #FAFAFA;
            }

            .clientSearchResult {
                text-align: left;
                line-height: 0.7em;
                font-size: 12px;
                color: #979797;
                padding: 0px;
                position: relative;
            }

            .smallClientProfilePic {
                display: block;
                position: relative;
            }

            .smallClientProfilePic img {
                height: 38px;
                margin: 7px 0 5px;
                width: 38px;
            }

            .catalogHeaderImg {
                display: block;
                position: relative;
                margin: 4px;
                height: 68px;
                width: 68px;
                background-position: 50% 50%;
                background-size: cover;
            }

            .table-list-search > tbody > tr > td:first-child {
                padding: 0;
            }

            .clientSearchResult .clientName {
                color: #6B6B6B;
                text-transform: none;
                letter-spacing: 1px;
                font-size: 21px;
                margin: 8px 0 0;
                display: inline-block;
            }

            .clientsearchresult:hover .clientName {
                color: #000;
            }

            .clientSearchResult:hover .clientName {
                color: #292929;
            }

            .clientSearchResult:hover {
                color: #636363;
            }

            .catalogDescription {
                line-height: 1.2em;
                font-size: 14px;
            }

            #invoiceTable .clientName, #orderTable .clientName {
                margin: 0;
                line-height: 23px;
                padding-top: 9px;
                font-size: 23px;
                letter-spacing: 2px;
            }

            .invoiceDescription, .orderDescription {
                line-height: 1.2em;
                font-size: 13px;
            }

            .btn-ghost-dark.btn-xs {
                padding: 8px 10px 3px;
                letter-spacing: 2px;
                font-size: 16px;
                margin-top: 3px;
            }

            .featureVisibility {
                width: 110px;
                display: inline-block;
                font-size: 20px;
                color: #4CC397;
                font-weight: bold;
                letter-spacing: 2px;
            }

            .featureVisibility .badge {
                font-size: 18px;
                height: 29px;
                border-radius: 2px;
                width: 29px;
                line-height: 31px;
                position: relative;
                top: -2px;
            }

            .featureVisibility .badge-success {
                background: #4CC397;
            }

            .featureVisibility .badge-default {
                background: #BBB;
            }

            .clientClosetStatusWrap .featureVisibility {
                width: 120px;
            }

            .clientClosetStatusWrap .featureVisibility .badge {
                height: 38px;
                width: 38px;
                display: block;
                float: left;
                margin: 3px 3px 0;
                line-height: 39px;
            }

            .clientClosetStatusWrap .featureVisibility .badge.notification {
                width: auto;
                height: 17px;
                top: -5px;
                left: initial;
                right: -5px;
                position: absolute;
                font-size: 12px;
                line-height: 18px;
                box-shadow: none;
            }

            .clientClosetStatusWrap .btn {
                padding: 7px 0px 2px;
                max-width: 100%;
                width: 200px;
                min-width: calc(100% - 125px);
                font-size: 19px;
                line-height: 26px;
                margin-bottom: 6px;
                margin-left: 5px;
            }

            .followUpWrap {
                padding: 10px 20px 20px;
                margin-top: 10px;
                border-top: 4px solid #4CC397;
                background: #F4FCF9;
                text-align: center;
            }

            .clientDetailsRow {
                cursor: default;
            }

            #client_add_responseMessage {
                margin: 5px 0 20px 0;
                max-width: 100%;
            }

            #clientSearchBox, #clientTable_filter, #orderTable_filter, #invoiceTable_filter {
                width: 450px;
                width: calc(100% - 380px - 20px);
                max-width: 450px;
                float: right;
                margin-top: 1px;
                min-width: 250px;
            }

            #clientTable_filter input, #orderTable_filter input, #invoiceTable_filter input, {
                box-shadow: 0px 2px 1px 0px rgba(0, 0, 0, 0.4);
                border-radius: 0;
                border: none;
                font-weight: normal;
                font-size: 14px;
                margin: 1px 0 0;
            }

            #sortInvoicesBy, #sortOrdersBy {
                width: 260px;
                width: calc(100% - 550px - 20px);
                max-width: 450px;
                float: left;
                margin-top: 1px;
                min-width: 250px;
            }

            #clientTable td.dataTables_empty, #orderTable td.dataTables_empty, #invoiceTable td.dataTables_empty {
                padding: 25px 20px 20px;
                font-family: medio;
                text-transform: uppercase;
                font-size: 22px;
                color: rgba(255, 255, 255, 0.74);
                letter-spacing: 4px;
                line-height: 0.8em;
                background-color: rgba(255, 255, 255, 0.17);
                cursor: default;
                border-top: none;
            }

            #clientTable td.dataTables_empty:hover {
                background-color: rgba(255, 255, 255, 0.17);
            }

            #invoiceTable td.dataTables_empty, #orderTable td.dataTables_empty {
                color: #232323;
                background: #F1F1F1;
            }

            table.dataTable thead th.sorting, table.dataTable thead th.sorting_asc, table.dataTable thead th.sorting_desc {
                background: none;
            }

            #clearFiltersBtn {
                padding: 8px 10px 3px;
                position: relative;
                top: 0px;
                margin-left: 12px;
                border: 1px solid #FFF;
                color: #FFF;
                vertical-align: baseline;
                line-height: 19px;
            }

            #clearFiltersBtn:hover {
                color: black;
            }

            #clearOrderTableFilters, #clearInvoiceTableFilters, #clearTableFilters {
                margin: 10px auto 0 auto;
                display: inline-block;
                background-color: rgba(255, 255, 255, 0.55);
                padding: 10px 30px;
                max-width: 95%;
            }

            #clearOrderTableFilters, #clearInvoiceTableFilters {
                color: #232323;
                border: 1px solid #232323;
            }

            .dashboardBtn {
                width: 160px;
                float: left;
                margin-top: 1px;
                border: 1px solid rgba(0, 0, 0, 0);
                height: 35px;
                padding: 8px;
                background: #101010;
                color: #FFF;
                box-shadow: 0px 2px 1px 0px rgba(0, 0, 0, 0.4);
            }

            .dashboardBtn.btn-success {
                width: 190px;
                float: left;
                background: #4CC397;
                border: none;
            }

            .dashboardBtn.btn-success:hover {
                border: 1px solid rgba(0, 0, 0, 0);
                background: #121212;
            }

            #clientFormsBtn {
                background-color: #121212;
                margin-left: 10px;
                position: relative;
            }

            #clientFormsBtn:hover {
                border: 1px solid rgba(0, 0, 0, 0);
                background: #FFF;
                color: #121212;
                text-shadow: none;
            }

            #previewNewClientFormsBtn, #editNewClientFormsBtn {
                padding: 11px 16px 6px;
                width: 48%;
                margin: 0 3px;
            }

            #closeNewClientFormEditorBtn {
                display: none;
            }

            .open #closeNewClientFormEditorBtn {
                display: block;
            }

            #closeClientFormModalBtn {
                display: block;
            }

            .open #closeClientFormModalBtn {
                display: none;
            }

            #clientDetailsPane {
            }

            #clientDetailsPane .tabs-style-linetriangle {
                margin-bottom: 15px;
            }

            #clientDetailsPane .tabs-style-linetriangle a {
                font-size: 21px;
                padding: 0 5px;
            }

            #clientDetailsPane .tabs-style-linetriangle a span {
                padding: 12px 5px;
            }

            #clientDetailsPane .tabs-style-linetriangle a i.fa {
                font-size: 22px;
                line-height: 1.1em;
                display: inline-block;
                width: 1.1em;
                vertical-align: text-bottom;
            }

            .clientDetails .badge {
                background-color: #49BB91;
                height: 30px;
                width: 30px;
                border-radius: 22px;
                line-height: 31px;
                position: static;
                vertical-align: middle;
                font-size: 23px;
                padding: 0;
            }

            .clientDetails p {
                border-top: 1px solid #F0F0F0;
                padding-top: 7px;
                color: #696969;
                font-size: 18px;
                font-family: medio;
            }

            #clientProfilePicWrap .btn.picLeftBtn, #clientProfilePicWrap .btn.picRightBtn {
                position: absolute;
                top: 48%;
                top: calc(50% - 18px);
                height: 36px;
                border: none;
                padding: 0;
                left: 5px;
                width: 10%;
                text-indent: 2px;
                line-height: 40px;
            }

            #clientProfilePicWrap .btn.picRightBtn {
                right: 5px;
                left: initial;
            }

            .bootstrap-modal-cropper .cropper-container {
                left: 0 !important;
            }

            .emailReceipts {
                border-top: 1px solid #DADADA;
                background: #F2F2F2;
                margin: 0 0px;
                position: relative;
            }

            .emailReceipts [class*="col-"], .emailReceipts [class*=" col-"] {
                padding: 10px 5px;
                text-align: center;
            }

            #contentWrap {
                margin-top: 10px;
            }

            #listTypeBtnGroup {
                margin: 0 auto 10px auto;
                width: 60%;
                display: block;
            }

            .btn-group .listTypeBtn {
                background: rgba(255, 255, 255, 0.92);
                border: none;
                width: 50%;
                box-shadow: none;
                color: #6B6B6B;
                text-shadow: none;
                font-size: 21px;
                padding: 13px 0 8px;
                /* padding: 0; */
                position: relative;
                border-top-right-radius: 3px;
                border-bottom-right-radius: 3px;
                overflow: hidden;
                border: 1px solid rgba(22, 22, 22, 0);
            }

            .btn-group .listTypeBtn.active {
                color: #FFF;
                width: 50%;
                background: #161616;
                padding: 13px 0 8px;
                border: 1px solid #161616;
            }

            .btn-group .listTypeBtn:first-child {
                border-top-left-radius: 3px;
                border-bottom-left-radius: 3px;
            }

            .stickyClosetBtn {
                background: none;
                display: block;
                float: left;
                line-height: 30px;
                height: 27px;
                width: 21px;
                font-size: 24px;
                margin: 5px 7px 0px -8px;
                padding: 0;
            }

            .stickyClosetBtn .fa-paperclip {
                color: transparent;
            }

            .clientSearchResult:hover .stickyClosetBtn .fa-paperclip {
                color: #BBB;
            }

            .clientSearchResult:hover .stickyClosetBtn:hover .fa-paperclip {
                text-shadow: 0px 2px 0px #CCC;
                color: #646464;
            }

            .clientSearchResult:hover .stickyClosetBtn.stickied .fa-paperclip {
                color: #4CC397;
            }

            .stickyClosetBtn.stickied .fa-paperclip {
                color: #4CC397;
                text-shadow: 0 0 3px #FFF, 0 0 3px #FFF, 0 0 3px #FFF;
            }

            .stickyClosetBtn:focus, .stickyClosetBtn:active, .stickyClosetBtn:active:focus {
                outline-color: rgba(0, 0, 0, 0);
            }

            .catalogRow .stickyClosetBtn {
                margin-bottom: 10px;
                margin-top: 10px;
            }

            .invoiceRow.emptyRow td, .catalogRow.emptyRow td, .clientRow.emptyRow td {
                cursor: default;
            }

            #NotesTab {
                opacity: 1;
                display: block;
                float: right;
            }

            #clientDetailsForm, #newClientDetailsForm {
                padding: 0 20px;
            }

            .form-group {
                margin-bottom: 5px;
            }

            #clientDetailsForm label.control-label, #newClientDetailsForm label.control-label {
                padding-top: 0;
                font-size: 11px;
                color: #444;
                height: 1em;
                line-height: 1em;
            }

            #clientDetailsForm input.form-control, #newClientDetailsForm input.form-control {
                box-shadow: none;
                border: none;
                border-bottom: 1px solid #2F2F2F;
                border-radius: 0;
                padding: 0;
                height: 25px;
                line-height: 30px;
                font-size: 15px;
            }

            #clientDetailsForm select.form-control, #newClientDetailsForm select.form-control {
                height: 23px;
                padding: 1px 6px;
                border-radius: 0;
                border: none;
                border-bottom: 1px solid #000;
                margin-top: 2px;
            }

            #newClientDetailsForm .checkbox {
                padding-top: 0px;
                min-height: 14px;
                line-height: 22px;
                font-size: 14px;
            }

            #clientDetailsForm .personalColorBox, #newClientDetailsForm .personalColorBox {
                padding: 3px;
                text-align: center;
                cursor: pointer;
                height: 70px;
                background: #1C1C1C;
                border-radius: 2px;
                background-position: 50% 50%;
                background-size: cover;
            }

            #newClientDetailsForm .personalColorBox.selected, #clientDetailsForm .personalColorBox.selected {
                display: block;
            }

            .personalColorBox span {
                padding: 17px 10px;
                display: inline-block;
                font-size: 13px;
                line-height: 1.3em;
                color: #CDCDCD;
                font-weight: bold;
            }

            #clientDetailsForm .personalColorBox.selected span {
                display: none;
            }

            #clientDetailsForm .personalColorBox:hover {
                background-color: #000;
            }

            #clientDetailsForm .personalColorBox:hover span {
                color: #FFF;
            }

            #newClientDetailsForm .personalColorBox.selected span {
                display: none;
            }

            #newClientDetailsForm .personalColorBox:hover {
                background-color: #000;
            }

            #newClientDetailsForm .personalColorBox:hover span {
                color: #FFF;
            }

            div#styleTypeSlider {
                width: 100%;
                height: 28px;
                background: transparent;
                position: relative;
                cursor: move;
            }

            #styleTypeSlider .ui-slider-handle {
                width: 16px;
                height: 26px;
                position: absolute;
                margin-left: -8px;
                margin-top: -13px;
                display: block;
                cursor: move;
            }

            span.ui-slider-handle:after {
                content: "\f041";
                font-family: FontAwesome;
                font-size: 30px;
                color: #000;
                opacity: 1;
                z-index: 1;
                position: relative;
                top: -6px;
            }

            .ui-slider-base-line {
                background: #898989;
                width: 100%;
                height: 1px;
                display: block;
                position: absolute;
                left: 0;
                right: 0;
                top: 50%;
            }

            .ui-slider-tick-mark, .ui-slider-tick-mark-large {
                display: inline-block;
                width: 1px;
                background: #000;
                height: 14px;
                position: absolute;
                top: 7px;
            }

            .ui-slider-tick-mark-large {
                height: 28px;
                top: 0px;
            }

            #clientDetailsForm .sliderLabels label.control-label, #newClientDetailsForm .sliderLabels label.control-label {
                width: 16.66%;
                width: calc(100%/6);
                float: left;
                text-align: center;
            }

            #clientDetailsForm .panel, #newClientDetailsForm .panel {
                border: 1px solid #2C2C2C;
                box-shadow: none;
            }

            #clientDetailsForm .panel-heading, #newClientDetailsForm .panel-heading {
                font-family: medio;
                font-size: 18px;
                text-transform: uppercase;
                letter-spacing: 4px;
                text-align: center;
                padding: 15px 0 9px 0;
                line-height: 0.5em;
                border: none;
                color: #F7F7F7;
                background: #1B1B1B;
            }

            #clientDetailsForm .panel-body {
                padding: 10px;
            }

            #clientDetailsForm .btn-ghost-dark.btn-xs {
                padding: 5px 9px 0px;
            }

            #clientDetailsForm hr {
                border-top: 1px dashed hsl(0, 0%, 74%);
            }

            #newClientDetailsForm .panel-body {
                padding: 10px;
            }

            #newClientDetailsForm .btn-ghost-dark.btn-xs {
                padding: 5px 9px 0px;
            }

            #newClientDetailsForm hr {
                border-top: 1px dashed hsl(0, 0%, 74%);
            }

            .newClientFormSection {
                padding: 10px 90px 10px 6px;
                position: relative;
                min-height: 110px;
            }

            .newClientFormSection .cover {
                position: absolute;
                z-index: 2;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(226, 226, 226, 0.8);
            }

            .newClientFormSection.included .cover {
                background: rgba(0, 0, 0, 0.05);
            }

            .newClientFormSection .form-control {
                background: transparent;
            }

            .newClientFormSection .newClientSectionControls {
                float: right;
                background-color: #333;
                width: 81px;
                min-height: 40px;
                margin-top: 0;
                margin-right: 0;
                color: #FFF;
                padding: 6px 4px 15px;
                height: 100%;
                border-radius: 3px;
                border-top-left-radius: 0;
                border-bottom-left-radius: 0;
            }

            .newClientSectionControls .switch {
                margin: 7px 0 7px;
            }

            #newClientDetailsForm .newClientFormSection .btn-ghost-dark {
                background: #888;
                border: 1px solid #888;
            }

            .emptyColors {
                padding: 17px;
                margin: 0 0 5px;
                border-radius: 3px;
                background: #F0F0F0;
                font-style: italic;
                color: #6F6F6F;
            }

            #hairColorChart, #eyeColorChart {
                width: 100%;
                text-align: center;
            }

            #hairColorChart .colorOption, #eyeColorChart .colorOption {
                width: 20%;
                width: 100px;
                height: 100px;
                text-align: center;
                text-decoration: none;
                color: #FFF;
                font-weight: bold;
                font-size: 12px;
                background-size: cover;
                margin: 0 3px 7px;
                position: relative;
                border-radius: 2px;
                display: flex;
                float: left;
                transition: none;
                cursor: pointer;
            }

            a.colorOption span {
                background: rgba(0, 0, 0, 0.16);
                width: 100%;
                padding: 3px;
                text-align: center;
                vertical-align: bottom;
                display: block;
                align-self: flex-end;
            }

            #hairColorChart a.colorOption.selected, #eyeColorChart a.colorOption.selected {
                border: 4px solid #4CC397;
                border-radius: 0;
                border-bottom: 0;
            }

            .colorOption.selected span, .colorOption.selected span {
                background: #4CC397;
            }

            #skintoneTable td {
                padding: 0;
            }

            .skintoneColor {
                width: 50%;
                height: 50px;
                float: left;
            }

            .skintonePaletteWrap {
                margin: 10px 2px;
                width: 13.5%;
                border-top: 6px solid #272727;
                min-width: 80px;
                display: inline-block;
                vertical-align: top;
            }

            .skintoneColor.selected {
                border: 5px solid #000;
                box-shadow: 0 0 10px -3px inset;
            }

            #clientColorHelperDiv {
                position: absolute;
                bottom: 0;
                top: 2px;
                right: 2px;
                width: 25%;
                height: 25%;
                z-index: 1;
                display: inline-block;
                border-radius: 2px;
            }

            #clientColorNav {
                position: fixed;
            }

            .colorSwatch {
                width: 24%;
                width: calc(25% - 4px);
                height: 70px;
                display: inline-block;
                margin: 0 2px;
                border-radius: 2px;
            }

            .shapeOption img {
                margin: 0px 0px 3px;
                width: 15%;
                width: calc(33% - 2px);
                min-width: 50px;
                max-width: 80px;
                border: 3px solid hsla(0, 0%, 1%, 0.85);
                border-radius: 3px;
                padding: 3px;
                opacity: .2;
                transition: all .2s ease;
            }

            .shapeOption.selected img {
                border-color: #4BC397;
                opacity: 1;
            }

            #faceShape.noSelection .shapeOption img, #bodyShape.noSelection .shapeOption img {
                opacity: 1;
            }

            .unknownInfo {
                letter-spacing: 0;
                color: hsl(0, 0%, 73%);
                font-family: sans-serif;
                font-size: 13px;
                font-style: italic;
            }

            #clientPhotoPane {
                margin: 0 auto;
            }

            .photosToUpload {
                list-style: none;
            }

            .photosToUpload li {
                display: inline-block;
                margin: 10px;
                height: 130px;
                max-width: 220px;
            }

            button.deleteClientPhotoBtn {
                position: absolute;
                top: 0px;
                right: 0px;
                opacity: 1;
                background-color: hsla(0, 100%, 100%, 0);
                padding: 3px 7px;
                color: hsl(0, 0%, 94%);
            }

            .photosToUpload li:hover button.deleteClientPhotoBtn {
                background: black;
                color: white;
                opacity: 1;
            }

            .graphRangeBtn.active {
                background: #333;
                color: white;
                box-shadow: none;
            }

            .earningsSection {
                text-align: center;
                background-color: rgba(255, 255, 255, 0.83);
                padding: 16px 15px 7px 60px;
                position: relative;
                margin: 4px 0;
                box-shadow: 0 6px 6px -7px #000;
                height: 119px;
            }

            .earningsSection label {
                font-size: 13px;
            }

            .earningsSection label span {
                font-style: italic;
                line-height: 1.1em;
                font-weight: normal;
                display: inline-block;
                font-size: 12px;
            }

            .earningsSection .fa {
                position: absolute;
                font-size: 42px;
                left: 0;
                top: 0;
                height: 100%;
                width: 50px;
                line-height: 117px;
                bottom: 0;
                background-color: rgba(0, 0, 0, 0.19);
                color: #FFF;
                text-shadow: 0 0 7px rgba(0, 0, 0, 0.26);
            }

            .commissionReportWrap {
                background: #FFF;
                padding: 0;
                border-radius: 0;
                border: none;
                box-shadow: 0 4px 5px -5px rgba(0, 0, 0, 0.3);
            }

            .commissionReportTable>tbody>tr:first-child>td {
                border: none;
            }

            .commissionReportTable>tbody>tr>td:first-child {
                width: 20px;
                padding: 10px 0 0 9px;
            }

            .commissionReportTable>tbody>tr>td:nth-child(2) {
                width: 80px;
                font-size: 16px;
                line-height: 1.5em;
                padding: 12px 0 9px 8px;
            }

            .commissionReportTable>tbody>tr>td:nth-child(3) {
                width: 180px;
                padding-top: 13px;
            }

            .commissionReportTable>tbody>tr>td:nth-child(4) {
                padding-top: 13px;
            }

            .commissionReportTable>tbody>tr>td:nth-child(5) {
                width: 85px;
                text-align: right;
                padding-right: 10px;
            }

            .commissionReportTable>tbody>tr>td {
                line-height: 1.7em;
            }

            .commissionReportTable .fa {
                font-size: 17px;
                color: #CDCDCD;
                line-height: 0.9em;
                vertical-align: bottom;
            }

            .commissionReportTable .fa-unlock-alt {
                color: #CDCDCD;
            }

            .commissionReportTable .fa-lock {
                color: #6BB323;
            }

            .reportDate {
                font-size: 13px;
                font-weight: bold;
                margin: 20px auto 8px;
                text-align: left;
            }

            /**** Invoice Styles ****/
            .clientCharge.row {
                padding: 0px;
                margin: 0px 0 4px;
                font-size: 13px;
                font-weight: bold;
                color: #131313;
                line-height: 46px;
                border-top: 1px solid #DDD;
                position: relative;
                margin-left: 50px;
                background-color: #FBFBFB;
            }

            .clientCharge.row.voided {
                background: #eee;
            }

            .invoiceStatusSymbol {
                padding-right: 5px;
                vertical-align: middle;
                position: absolute;
                top: -1px;
                bottom: 0px;
                left: -50px;
                width: 50px;
                background-color: #4CC397;
                color: #FFF;
                font-size: 26px;
                text-align: center;
                padding: 0;
                line-height: 80px;
            }

            #orderTable .invoiceStatusSymbol, #invoiceTable .invoiceStatusSymbol {
                line-height: 52px;
                height: 52px;
                border-radius: 52px;
                margin-top: 7px;
                left: 12px;
            }

            .invoicePaid {
                color: #4CC397;
                line-height: 13px;
            }

            .invoiceOutstanding {
                color: #333;
            }

            .invoiceOverdue {
                color: #E84B4B;
            }

            .invoiceVoid {
                color: #aaa;
            }

            .invoiceStatusSymbol.fa-send-o {
                background-color: #232323;
            }

            .invoiceStatusSymbol.fa-warning {
                background-color: #E84B4B;
            }

            .invoiceStatusSymbol.fa-ban {
                background-color: #ccc;
            }

            #fullScreenIframe {
                display: none;
            }

            #fullScreenIframe .iframeTopBar {
                padding: 10px;
                background: #FFFFFF;
                border-bottom: 3px double #E2E2E2;
                text-align: center;
                height: 60px;
            }

            #fullScreenIframe.open {
                display: block;
                background: #FFFFFF;
                position: fixed;
                top: 10px;
                left: 10px;
                bottom: 10px;
                right: 10px;
                width: calc(100% - 20px);
                height: calc(100% - 20px);
                border: none;
                margin: 0;
                padding: 0;
                overflow: hidden;
                z-index: 999999;
                box-shadow: 0 0 40px 10px #000;
            }

            #fullScreenIframe .iframeBody {
                width: 100%;
                height: calc(100% - 60px);
                -webkit-overflow-scrolling: touch;
                overflow-y: scroll;
            }

            #clientSelectionList li {
                list-style-type: none;
                text-align: left;
                padding: 7px 15px 3px;
                font-size: 21px;
                font-family: Medio;
                background: #fff;
                margin: 4px 0;
                line-height: 1.5em;
                border-left: 7px solid #ccc;
                cursor: pointer;
            }

            #clientSelectionList {
                max-height: calc(100vh - 230px);
                margin: 0;
                padding: 1px 5px 4px;
            }

            #clientSelectionList li:hover {
                background: #F3FDF9;
                border-color: #4CC397;
            }

            @media (max-width: 480px) {
                #main-content h3.darkHeader {
                    padding: 10px 36px 4px;
                    text-indent: 0;
                }

                #listTypeBtnGroup {
                    margin: 0 auto 10px auto;
                    width: 100%;
                }

                #clientTable .clientSearchResult {
                    padding-bottom: 0;
                }

                .viewClosetBtn {
                    width: 100%;
                    margin-bottom: 10px;
                }

                div#main-content {
                    padding: 0;
                }
            }

            @media (max-width: 1110px) {
                /** 992px **/ .hidden-md-sm {
                    display:none !important;
                }
            }

            @media (max-width: 1260px) {
                .clientClosetStatusWrap .featureVisibility {
                    width: 100%;
                    text-align: center;
                    margin: 0 0 10px;
                }

                .clientClosetStatusWrap .featureVisibility .badge {
                    float: none;
                    display: inline-block;
                    margin: 0;
                }

                .clientClosetStatusWrap .btn {
                    width: 100%;
                }
            }

            @media (max-width : 991px) {
                #NotesTab {
                    opacity: 0;
                    display: none;
                }

                #NotesTab.active {
                    opacity: 1;
                    display: block;
                    width: 100%;
                }

                #clientPhotoPane {
                    width: 100%;
                }
            }

            @media (max-width: 850px) {
                #main-content {
                    padding:0;
                }

                #mainMenuBar {
                    width: 100%;
                    position: static;
                }

                #mainMenuBar .topNavBtn {
                    max-width: 47%;
                    min-width: 110px;
                    display: inline-block;
                    position: relative;
                    margin: 1px 0;
                    c height: 80px;
                    padding-top: 14px;
                    height: 82px;
                }

                .loadingPaneWrap, .clientListPaneWrap, .catalogListPaneWrap, .earningsPaneWrap, .menswearPaneWrap, .invoicesPaneWrap {
                    margin-left: 0;
                    margin: 0;
                }

                .clientListPaneWrap .col-md-12, .catalogListPaneWrap .col-md-12, .menswearPaneWrap .col-md-12, .earningsPaneWrap .col-md-12, .invoicesPaneWrap .col-md-12 {
                    padding: 0 5px 0;
                }

                #menswearPane .col-md-8.col-lg-9, #invoicesPane .col-md-8.col-lg-9, #menswearPane .col-md-4.col-lg-3, #invoicesPane .col-md-4.col-lg-3 {
                    padding-left: 0;
                }
            }

            @media (max-width: 767px) {
                .viewClosetBtn {
                    width:100%;
                    margin-bottom: 10px;
                }

                .viewClosetBtnWrap {
                    width: 50%;
                    margin-bottom: 10px;
                }

                #clientSearchBox {
                    width: 100%;
                    padding: 10px 0 0;
                    margin: 0 auto;
                    float: none;
                }

                .clientClosetStatusWrap {
                    display: block;
                    width: 100%;
                    text-align: center;
                }

                .clientClosetStatusWrap .btn.pull-right {
                    float: none !important;
                }

                #clientColorNav {
                    position: static;
                }

                #eyeColorChart .colorOption {
                    display: inline-block;
                    float: none;
                }
            }

            @media (max-width: 680px) {
                #clientSearchBox, #clientTable_filter, #invoiceTable_filter, #orderTable_filter, #sortInvoicesBy {
                    width: 90%;
                    margin: 10px auto 0;
                    float: none;
                }

                #clientListPane .dashboardBtn, #catalogListPane .dashboardBtn {
                    float: none;
                    margin: 9px 0px 0px !important;
                    display: inline-block;
                }
            }

            @media (max-width: 530px) {
                #previewNewClientFormsBtn, #editNewClientFormsBtn {
                    width: 80%;
                    margin: 0 auto 10px;
                }
            }

            @media (max-width: 480px) {
                #contentWrap {
                    padding: 0 5px;
                }

                #mainMenuBar .topNavBtn {
                    min-width: 140px;
                }

                #invoiceListPane, #clientListPane, #orderListPane, #catalogListPane {
                    margin: 0 -5px;
                }

                .loadingPaneWrap .col-md-12, .clientListPaneWrap .col-md-12, .catalogListPaneWrap .col-md-12, .earningsPaneWrap .col-md-12, .menswearPaneWrap .col-md-12, .invoicesPaneWrap .col-md-12 {
                    padding: 0;
                }

                #invoicesPane, #menswearPane {
                    margin: 0;
                }

                .clientSearchResult {
                    width: 100%;
                }

                .viewClosetBtnWrap {
                    width: 100%;
                    margin-bottom: 10px;
                }

                #clientSearchBox, #orderTable_filter, #invoiceTable_filter, #clientTable_filter {
                    width: 95%;
                    margin: 10px 10px 0 10px;
                    max-width: initial;
                    min-width: initial;
                    float: none;
                }

                #closeNewClientFormEditorBtn span {
                    display: none;
                }

                #clientFormModal h4.modal-title {
                    padding: 0 38px;
                }

                #newClientDetailsForm {
                    padding: 0 0px;
                }
            }

            /*****************************/
            /** Styles for Menswear Tab **/
            /*****************************/
            .darkMenu li a {
                display: inline-block;
                width: 100%;
                padding: 15px 0 11px 47px;
                color: white;
                text-decoration: none;
                position: relative;
            }

            .darkMenu li {
                /* padding: 14px 0 14px 47px; */
                /* border-top: 1px solid #444; */
                border-left: 0;
                border-right: 0;
                text-align: left;
                border-bottom: 1px solid #1F1F1F;
            }

            .darkMenu li:first-child {
                border-top: 1px solid #1F1F1F;
            }

            .darkMenu {
                position: relative;
                list-style: none;
                padding: 0;
                margin: 0;
                font-size: 15px;
                text-transform: uppercase;
                letter-spacing: 5px;
                text-align: center;
                font-family: medio;
            }

            .darkMenu li a i.fa {
                position: absolute;
                left: 0;
                top: 8px;
                margin: 0 7px;
                font-size: 18px;
                line-height: 22px;
                text-align: center;
                display: block;
                width: 30px;
                height: 30px;
                color: white;
                /* background: #4CC397; */
                border-radius: 2px;
                text-indent: 4px;
                padding: 5px 0 0;
            }

            .darkMenu li a:hover {
                background: #444;
            }

            .darkTabMenu {
                list-style: none;
                padding: 0;
                margin: 0;
                width: 100%;
                text-align: center;
            }

            .darkTabMenu li {
                display: inline-block;
                width: 48%;
                max-width: 230px;
                margin: 2px 2px;
            }

            .darkTabMenu li a {
                text-align: right;
                position: relative;
                color: #FFF;
                font-family: Medio;
                text-transform: uppercase;
                text-decoration: none;
                background: #121212;
                padding: 0px 9px 3px 45px;
                display: inline-block;
                width: 100%;
                max-width: 230px;
                height: 44px;
                line-height: 44px;
                font-size: 18px;
                letter-spacing: 4px;
                border: 1px solid rgba(0, 0, 0, 0);
            }

            .darkTabMenu li a:hover {
                background: white;
                color: black;
                border: 1px solid #232323;
            }

            .darkTabMenu li a i {
                position: absolute;
                left: 12px;
                top: 12px;
            }

            @media (max-width: 420px) {
                .darkTabMenu li a {
                    letter-spacing:2px;
                    font-size: 16px;
                    padding-left: 38px
                }
            }

            .row.menswearPaneWrap {
                position: relative;
            }

            @media (min-width: 851px) {
                .row.menswearPaneWrap {
                    margin: -5px -7px 20px;
                    position: relative;
                }
            }

            @media (max-width: 850px) {
                .row.menswearPaneWrap {
                    margin: -5px 0px 20px;
                }
            }

            #main-content-wrap > .row {
                margin-top: 0;
            }

            .dataTables_filter.input-group input, .dataTables_filter.input-group button {
                border: none;
                border-radius: 1px;
                box-shadow: 0 1px 3px -1px #000;
            }

            @media (max-width: 480px) {
                #sortOrdersBy, #orderTable_filter {
                    width:100%;
                    margin: 0 0 10px;
                }
            }

            #menswearPane h1 {
                color: white;
                text-shadow: 0 0 3px #000, 0 0 13px #000, 0 0 13px rgba(0, 0, 0, 0.58);
            }

            @media (max-width: 700px) {
                #menswearPane h1 {
                    color: #232323;
                    text-shadow: none;
                }
            }

            #menswearPane .panel {
                padding: 20px;
                text-align: left;
                font-size: 13px;
                margin-bottom: 20px;
            }

            #menswearPane .tab-pane:after {
                clear: both;
                content: " ";
                display: block;
                height: 1px;
            }

            #menswearPane .panel.resource {
                text-align: center;
                width: 45%;
                margin: 0 8px 15px;
                vertical-align: top;
                height: 380px;
                min-width: 300px;
                padding: 0;
                border: 3px solid #232323;
                display: inline-block;
            }

            #menswearPane .panel.resource:hover {
                border-color: #4CC397;
            }

            #menswearPane .panel.resource a {
                display: inline-block;
                text-decoration: none;
                color: #232323;
                font-size: 12px;
                font-weight: bold;
                padding: 0 15px;
            }

            #menswearPane .panel.resource h3 {
                color: #232323;
                text-decoration: none;
                margin-bottom: 0;
            }

            #menswearPane #pricingTab .panel-heading {
                margin-bottom: 0;
                background: #272727;
                color: #FFF;
                padding: 13px 15px 6px;
            }

            #menswearPane #pricingTab .panel .panel {
                background: #eee;
                box-shadow: none;
                border: 1px solid;
                border-top: none;
            }

            @media (max-width: 700px) {
                #menswearPane .panel.resource {
                    width:
                }
            }
        </style>
    </head>
    <body class="fixed-nav" id="homePage">
        <div class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background: #253031;box-shadow: none; border: none; border-radius: 0;">
            <div style="position:absolute;right:10px;top:8px;">
                <a href="logout.php" class='btn btn-ghost' style="min-width: 100px;">Logout</a>
            </div>
            <div style="position:absolute;left:10px;top:8px;">
                <button id="mainBackButton" class='btn btn-ghost' style="display:none;min-width: 100px;">
                    <i class="fa fa-angle-double-left"></i>
                    Back
                </button>
            </div>
            <div class="navbar-header" style="width: 100%;text-align: center;float: left;">
                <h2 style="margin:0;text-align: center;width: 100%;">
                    <a class="navbar-brand hidden-xs" href="#" style="float: none; color: #BF9B30; font-size: 23px; line-height: 1.8em; padding: 7px; display: inline-block;">A Creative ClichÉ</a>
                    <a class="navbar-brand visible-xs" href="#" style="float: none; color: #BF9B30; font-size: 23px;line-height: 1.2em;">H &amp;S</a>
                </h2>
            </div>
        </div>
        <div style=" position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(119, 119, 119, 0.4); z-index: -1; "></div>
        <div class="container-fluid">
            <div id="content">
                <div id="contentWrap" class="container-fluid">
                    <!--<h2>Results</h2>-->
                    <div id="main-content" class="container-fluid">
                        <div id="main-content-wrap" style="position:relative;">
                            <div id="mainMenuBar" class="text-center">
                                <a href="profile.php" class='btn btn-ghost-dark topNavBtn'>
								<img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTYuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjUxMnB4IiBoZWlnaHQ9IjUxMnB4IiB2aWV3Qm94PSIwIDAgOTcuOTY4IDk3Ljk2OCIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgOTcuOTY4IDk3Ljk2ODsiIHhtbDpzcGFjZT0icHJlc2VydmUiPgo8Zz4KCTxnPgoJCTxwYXRoIGQ9Ik00OS41NDEsMzguNjU1YzEuNjE3LDAsMy4xNTgsMC4zMzgsNC41NTksMC45NDZjMC4xMDUtMi4yODYsMC44OTMtNC40LDIuMTU3LTYuMTVjLTAuODktMC4xODYtMS44MDgtMC4yODUtMi43NDgtMC4yODUgICAgaC04LjkwNmMtMC45MzgsMC0xLjg1NiwwLjA5OC0yLjczOSwwLjI4MmMxLjM0NywxLjg2OSwyLjE1Miw0LjE1LDIuMTY1LDYuNjJDNDUuNjY2LDM5LjE2OCw0Ny41NDQsMzguNjU1LDQ5LjU0MSwzOC42NTV6IiBmaWxsPSIjZDJiZjU1Ii8+CgkJPGNpcmNsZSBjeD0iNDkuMDU0IiBjeT0iMjEuOTU0IiByPSIxMC40OTYiIGZpbGw9IiNkMmJmNTUiLz4KCQk8cGF0aCBkPSJNNjUuNTM5LDUwLjM2YzUuMzQyLDAsOS42Ny00LjMzLDkuNjctOS42N2MwLTUuMzQyLTQuMzI4LTkuNjctOS42Ny05LjY3Yy01LjI5MiwwLTkuNTgzLDQuMjUxLTkuNjYzLDkuNTI0ICAgIGMzLjA0OSwxLjkxMiw1LjE4Nyw1LjE0Niw1LjU3Nyw4LjlDNjIuNjk1LDUwLjAyNiw2NC4wNzYsNTAuMzYsNjUuNTM5LDUwLjM2eiIgZmlsbD0iI2QyYmY1NSIvPgoJCTxwYXRoIGQ9Ik0zMi41NzEsMzEuMDE5Yy01LjM0MywwLTkuNjcxLDQuMzI5LTkuNjcxLDkuNjdzNC4zMjgsOS42NjksOS42NzEsOS42NjljMS44OTIsMCwzLjY1MS0wLjU1Myw1LjE0My0xLjQ5MiAgICBjMC40NzUtMy4wOTEsMi4xMzItNS43OTQsNC40OTktNy42MzRjMC4wMS0wLjE4MSwwLjAyNy0wLjM2LDAuMDI3LTAuNTQzQzQyLjI0LDM1LjM0OCwzNy45MSwzMS4wMTksMzIuNTcxLDMxLjAxOXoiIGZpbGw9IiNkMmJmNTUiLz4KCQk8cGF0aCBkPSJNNzEuODIsMzAuODEzYzMuMDQ5LDEuOTEyLDUuMTg3LDUuMTQ2LDUuNTc2LDguOTAxYzEuMjQxLDAuNTgxLDIuNjIzLDAuOTE2LDQuMDg2LDAuOTE2YzUuMzQyLDAsOS42Ny00LjMyOSw5LjY3LTkuNjcgICAgYzAtNS4zNDEtNC4zMjgtOS42Ny05LjY3LTkuNjdDNzYuMTkxLDIxLjI4OSw3MS45LDI1LjU0MSw3MS44MiwzMC44MTN6IiBmaWxsPSIjZDJiZjU1Ii8+CgkJPGNpcmNsZSBjeD0iNDkuNTQxIiBjeT0iNTAuNjczIiByPSI5LjY3MSIgZmlsbD0iI2QyYmY1NSIvPgoJCTxwYXRoIGQ9Ik02OS42NDMsNTEuMDE5aC04LjE0NGMtMC4wODksMy4yNTgtMS40NzksNi4xOTItMy42NzksOC4zMDFjNi4wNjgsMS44MDYsMTAuNTA5LDcuNDM0LDEwLjUwOSwxNC4wODJ2My4wOTIgICAgYzguMDQtMC4yOTcsMTIuNjc0LTIuNTczLDEyLjk3OS0yLjcyOWwwLjY0Ni0wLjMyOGgwLjA2N1Y2My40MDFDODIuMDIzLDU2LjU3Myw3Ni40NjksNTEuMDE5LDY5LjY0Myw1MS4wMTl6IiBmaWxsPSIjZDJiZjU1Ii8+CgkJPHBhdGggZD0iTTg1LjU4NSw0MS4yODloLTguMTQyYy0wLjA4OCwzLjI1OC0xLjQ3OSw2LjE5Mi0zLjY3OCw4LjMwMWM2LjA2OCwxLjgwNiwxMC41MDgsNy40MzMsMTAuNTA4LDE0LjA4MXYzLjA5MiAgICBjOC4wMzktMC4yOTYsMTIuNjc0LTIuNTcyLDEyLjk3OS0yLjcyOWwwLjY0Ni0wLjMyN2gwLjA2OVY1My42NzFDOTcuOTY3LDQ2Ljg0NCw5Mi40MTMsNDEuMjg5LDg1LjU4NSw0MS4yODl6IiBmaWxsPSIjZDJiZjU1Ii8+CgkJPHBhdGggZD0iTTQxLjI1Niw1OS4zMTljLTIuMTg5LTIuMDk5LTMuNTc1LTUuMDE3LTMuNjc3LTguMjU0Yy0wLjMwMS0wLjAyMi0wLjYtMC4wNDctMC45MDgtMC4wNDdoLTguMjAzICAgIGMtNi44MjgsMC0xMi4zODMsNS41NTUtMTIuMzgzLDEyLjM4M3YxMC4wMzdsMC4wMjUsMC4xNTVsMC42OTEsMC4yMThjNS4yMjcsMS42MzMsOS44OTMsMi4zODMsMTMuOTQ0LDIuNjIxdi0zLjAzMSAgICBDMzAuNzQ3LDY2Ljc1NCwzNS4xODYsNjEuMTI2LDQxLjI1Niw1OS4zMTl6IiBmaWxsPSIjZDJiZjU1Ii8+CgkJPHBhdGggZD0iTTUzLjY0Myw2MS4wMDNoLTguMjA2Yy02LjgyOCwwLTEyLjM4Myw1LjU1Ny0xMi4zODMsMTIuMzgydjEwLjAzN2wwLjAyNiwwLjE1N2wwLjY5LDAuMjE2ICAgIGM2LjUxNiwyLjAzNSwxMi4xNzcsMi43MTUsMTYuODM1LDIuNzE1YzkuMTAxLDAsMTQuMzc1LTIuNTk1LDE0LjcwMS0yLjc2bDAuNjQ2LTAuMzI4aDAuMDY4VjczLjM4NSAgICBDNjYuMDIzLDY2LjU1OCw2MC40NjksNjEuMDAzLDUzLjY0Myw2MS4wMDN6IiBmaWxsPSIjZDJiZjU1Ii8+CgkJPHBhdGggZD0iTTE2LjQ4Niw0MC45MzhjMS40NjMsMCwyLjg0NC0wLjMzNSw0LjA4Ni0wLjkxNmMwLjM5LTMuNzU1LDIuNTI3LTYuOTksNS41NzYtOC45MDJjLTAuMDgtNS4yNzEtNC4zNzEtOS41MjMtOS42NjItOS41MjMgICAgYy01LjM0MywwLTkuNjcxLDQuMzI5LTkuNjcxLDkuNjcxQzYuODE1LDM2LjYwOSwxMS4xNDMsNDAuOTM4LDE2LjQ4Niw0MC45Mzh6IiBmaWxsPSIjZDJiZjU1Ii8+CgkJPHBhdGggZD0iTTI0LjIwMiw0OS44OTljLTIuMTk4LTIuMTA5LTMuNTg5LTUuMDQ0LTMuNjc3LTguMzAzaC04LjE0M0M1LjU1NCw0MS41OTcsMCw0Ny4xNTIsMCw1My45Nzl2MTAuMDM3aDAuMDY5bDAuNjQ2LDAuMzI3ICAgIGMwLjMwNiwwLjE1NCw0LjkzOSwyLjQzMywxMi45NzksMi43Mjh2LTMuMDkyQzEzLjY5NCw1Ny4zMzIsMTguMTMzLDUxLjcwNCwyNC4yMDIsNDkuODk5eiIgZmlsbD0iI2QyYmY1NSIvPgoJCTxwYXRoIGQ9Ik0yNy43OTYsMzAuMDYzYzEuMTYtMC40NywyLjkzLTEuMDQ3LDQuNjItMS4wNDdjMS45NjcsMCwzLjg5MSwwLjUwNiw1LjYwNywxLjQ2OWMwLjM4Mi0wLjM3NSwwLjczMi0wLjc4MywxLjA1LTEuMjIgICAgYy0xLjYzLTIuMTQxLTIuNTItNC43NjUtMi41Mi03LjQ2NGMwLTEuODE4LDAuNDA2LTMuNjIyLDEuMTgtNS4yNjFjLTEuNzYyLTEuNTkyLTQuMDEtMi40NjEtNi4zOTktMi40NjEgICAgYy00LjM0OCwwLTguMTMzLDIuOTQzLTkuMjQxLDcuMDg4QzI1LjM0MSwyMy4wNTcsMjcuNDU3LDI2LjM2MSwyNy43OTYsMzAuMDYzeiIgZmlsbD0iI2QyYmY1NSIvPgoJCTxwYXRoIGQ9Ik01OS4xMTcsMjguNzE4YzAuMzM2LDAuNTM0LDAuNzI5LDEuMDM3LDEuMTc1LDEuNTA1YzEuNTg4LTAuNzkyLDMuMzM0LTEuMjA4LDUuMDkyLTEuMjA4ICAgIGMxLjcyOSwwLDMuMzg2LDAuNDQyLDQuNDcyLDAuODEyYzAuMzQtNC4wMTMsMi43NjctNy41NTUsNi40LTkuMzVjLTEuMzMyLTMuODA1LTQuOTM4LTYuNDAyLTkuMDIxLTYuNDAyICAgIGMtMi42NCwwLTUuMTQsMS4wODQtNi45NDUsMi45OTJjMC42MzQsMS41MTIsMC45NTUsMy4xMDEsMC45NTUsNC43M0M2MS4yNDQsMjQuMjkyLDYwLjUxLDI2LjY3LDU5LjExNywyOC43MTh6IiBmaWxsPSIjZDJiZjU1Ii8+Cgk8L2c+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==" style="
    width: 50%;
"/>
                                    <p>Clients</p>

                                </a>
                                <a href="stylecreator.php" id="clientPageBtn" class='btn btn-ghost-dark topNavBtn'>
								<img src="data:image/svg+xml;base64,
PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTEyIDUxMjsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTIiIGhlaWdodD0iNTEyIiBjbGFzcz0iIj48Zz48cGF0aCBzdHlsZT0iZmlsbDojRDRDMTU1IiBkPSJNNTExLjcsNDA0LjAwMUM1MTAuMiwzOTcuMDk5LDUwNC4yLDM5Miw0OTcsMzkyaC05MWMtOC40MDEsMC0xNSw2LjU5OS0xNSwxNXY2MCAgYzAsOC40MDEsNi41OTksMTUsMTUsMTVoOTFjOC40MDEsMCwxNS02LjU5OSwxNS0xNXYtNjBDNTEyLDQwNS44MDEsNTEyLDQwNC45LDUxMS43LDQwNC4wMDF6IiBkYXRhLW9yaWdpbmFsPSIjRTUwMDI3IiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iI0M5OTUxQiI+PC9wYXRoPjxwYXRoIHN0eWxlPSJmaWxsOiMzMzMyMkEiIGQ9Ik0xMDYsMzkySDE1Yy03LjIsMC0xMy4yLDUuMDk5LTE0LjcsMTIuMDAxQzAsNDA0LjksMCw0MDUuODAxLDAsNDA3djYwYzAsOC40MDEsNi41OTksMTUsMTUsMTVoOTEgIGM4LjQwMSwwLDE1LTYuNTk5LDE1LTE1di02MEMxMjEsMzk4LjU5OSwxMTQuNDAxLDM5MiwxMDYsMzkyeiIgZGF0YS1vcmlnaW5hbD0iI0ZEMDAzQSIgY2xhc3M9IiIgZGF0YS1vbGRfY29sb3I9IiMyMEFCQjYiPjwvcGF0aD48cmVjdCB4PSIxODEiIHk9IjYwIiBzdHlsZT0iZmlsbDojMzMzMjJBIiB3aWR0aD0iMTUwIiBoZWlnaHQ9IjkwIiBkYXRhLW9yaWdpbmFsPSIjQzEwMDFGIiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iI0QyQkY1NSI+PC9yZWN0PjxyZWN0IHg9IjI1NiIgeT0iNjAiIHN0eWxlPSJmaWxsOiNGMEU3RTgiIHdpZHRoPSI3NSIgaGVpZ2h0PSI5MCIgZGF0YS1vcmlnaW5hbD0iIzk4MDAxNyIgY2xhc3M9IiIgZGF0YS1vbGRfY29sb3I9IiM5ODAwMTciPjwvcmVjdD48cG9seWdvbiBzdHlsZT0iZmlsbDojRDRDMTU1IiBwb2ludHM9IjM0NiwwIDMxMCw5MCAyMDIsOTAgMTY2LDAgIiBkYXRhLW9yaWdpbmFsPSIjRTUwMDI3IiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iI0M5OTUxQiI+PC9wb2x5Z29uPjxwb2x5Z29uIHN0eWxlPSJmaWxsOiMzMzMyMkEiIHBvaW50cz0iMzQ2LDAgMzEwLDkwIDI1Niw5MCAyNTYsMCAiIGRhdGEtb3JpZ2luYWw9IiNDMTAwMUYiIGNsYXNzPSIiIGRhdGEtb2xkX2NvbG9yPSIjRDJCRjU1Ij48L3BvbHlnb24+PHBhdGggc3R5bGU9ImZpbGw6I0Q0QzE1NSIgZD0iTTUxMiw0MDd2MTVoLTkxdjc1YzAsOC40MDEtNi41OTksMTUtMTUsMTVIMTA2Yy04LjQwMSwwLTE1LTYuNTk5LTE1LTE1di03NUgwdi0xNSAgYzAtMS4xOTksMC0yLjEsMC4zLTIuOTk5bDI4LjYtMjc5LjIwMkMzMC43LDEwNS45MDEsNDQuNSw5MCw2Mi44LDg1LjIwMUw5MSw3Ny45OTlsMTY1LDU3LjkwMmwxNjUtNTcuOTAybDI4LjIsNy4yMDIgIGMxOC4zLDUuMDk5LDMyLjEsMjAuNywzMy45LDM5Ljg5OWwyOC42LDI3OC45MDFDNTEyLDQwNC45LDUxMiw0MDUuODAxLDUxMiw0MDd6IiBkYXRhLW9yaWdpbmFsPSIjRTUwMDI3IiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iI0M5OTUxQiI+PC9wYXRoPjxwYXRoIHN0eWxlPSJmaWxsOiMzMzMyMkEiIGQ9Ik01MTIsNDA3djE1aC05MXY3NWMwLDguNDAxLTYuNTk5LDE1LTE1LDE1SDI1NlYxMzUuOTAxbDE2NS01Ny45MDJsMjguMiw3LjIwMiAgYzE4LjMsNS4wOTksMzIuMSwyMC43LDMzLjksMzkuODk5bDI4LjYsMjc4LjkwMUM1MTIsNDA0LjksNTEyLDQwNS44MDEsNTEyLDQwN3oiIGRhdGEtb3JpZ2luYWw9IiNDMTAwMUYiIGNsYXNzPSIiIGRhdGEtb2xkX2NvbG9yPSIjRDJCRjU1Ij48L3BhdGg+PHBhdGggc3R5bGU9ImZpbGw6I0MwQzJEMyIgZD0iTTIyNiwyNDBjLTguMjkxLDAtMTUtNi43MDktMTUtMTV2LTkwYzAtOC4yOTEsNi43MDktMTUsMTUtMTVzMTUsNi43MDksMTUsMTV2OTAgIEMyNDEsMjMzLjI5MSwyMzQuMjkxLDI0MCwyMjYsMjQweiIgZGF0YS1vcmlnaW5hbD0iI0U2RUVGRiIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBkYXRhLW9sZF9jb2xvcj0iI0M1Q0RERiI+PC9wYXRoPjxwYXRoIHN0eWxlPSJmaWxsOiNDMEMyRDMiIGQ9Ik0yODYsMjQwYy04LjI5MSwwLTE1LTYuNzA5LTE1LTE1di05MGMwLTguMjkxLDYuNzA5LTE1LDE1LTE1czE1LDYuNzA5LDE1LDE1djkwICBDMzAxLDIzMy4yOTEsMjk0LjI5MSwyNDAsMjg2LDI0MHoiIGRhdGEtb3JpZ2luYWw9IiNDNUM5RjciIGNsYXNzPSIiIGRhdGEtb2xkX2NvbG9yPSIjQzBDMkQ0Ij48L3BhdGg+PHBhdGggc3R5bGU9ImZpbGw6I0Q0QzE1NSIgZD0iTTM0Ni4wMTUsNDUyYy01LjUwOCwwLTEwLjc5Ni0zLjAzMi0xMy40MzMtOC4yOTFsLTMwLTYwYy0zLjcwNi03LjQxMi0wLjcwMy0xNi40MjEsNi43MDktMjAuMTI3ICBjNy40MjctMy42NzcsMTYuNDA2LTAuNzAzLDIwLjEyNyw2LjcwOWwzMCw2MGMzLjcwNiw3LjQxMiwwLjcwMywxNi40MjEtNi43MDksMjAuMTI3QzM1MC41NTYsNDUxLjQ4NywzNDguMjcxLDQ1MiwzNDYuMDE1LDQ1MnoiIGRhdGEtb3JpZ2luYWw9IiNFNTAwMjciIGNsYXNzPSIiIGRhdGEtb2xkX2NvbG9yPSIjQzk5NTFCIj48L3BhdGg+PGc+Cgk8cGF0aCBzdHlsZT0iZmlsbDojMzMzMjJBIiBkPSJNMTY1Ljk4NSw0NTJjLTIuMjU2LDAtNC41NDEtMC41MTMtNi42OTQtMS41ODJjLTcuNDEyLTMuNzA2LTEwLjQxNS0xMi43MTUtNi43MDktMjAuMTI3bDMwLTYwICAgYzMuNzA2LTcuNDEyLDEyLjcyOS0xMC4zODYsMjAuMTI3LTYuNzA5YzcuNDEyLDMuNzA2LDEwLjQxNSwxMi43MTUsNi43MDksMjAuMTI3bC0zMCw2MEMxNzYuNzgxLDQ0OC45NjgsMTcxLjQ5Myw0NTIsMTY1Ljk4NSw0NTJ6ICAgIiBkYXRhLW9yaWdpbmFsPSIjRkQwMDNBIiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iIzIwQUJCNiI+PC9wYXRoPgoJPHBhdGggc3R5bGU9ImZpbGw6IzMzMzIyQSIgZD0iTTQyMSw3Ny45OTlMMjY0LjEwMSwxNzcuOWMtMy45LDAuOTAxLTYsMi4xLTguMTAxLDIuMWMtMi4xLDAuNjAxLTQuMiwwLTcuOC0yLjFMOTEsNzcuOTk5ICAgQzg4LjksMzcuMiwxMjIuMTk5LDAsMTY2LDBjNS40LDAsMTAuMjAxLDIuNzAxLDEyLjksNy4yTDI1NiwxMzUuOTAxTDMzMy4xLDcuMkMzMzUuNzk5LDIuNzAxLDM0MC42LDAsMzQ2LDAgICBDMzg3LjEsMCw0MjIuNSwzMy42LDQyMSw3Ny45OTl6IiBkYXRhLW9yaWdpbmFsPSIjRkQwMDNBIiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iIzIwQUJCNiI+PC9wYXRoPgo8L2c+PHBhdGggc3R5bGU9ImZpbGw6I0Q0QzE1NSIgZD0iTTQyMSw3Ny45OTlMMjY0LjEwMSwxNzcuOWMtMy45LDAuOTAxLTYsMi4xLTguMTAxLDIuMXYtNDQuMDk5TDMzMy4xLDcuMiAgQzMzNS43OTksMi43MDEsMzQwLjYsMCwzNDYsMEMzODcuMSwwLDQyMi41LDMzLjYsNDIxLDc3Ljk5OXoiIGRhdGEtb3JpZ2luYWw9IiNFNTAwMjciIGNsYXNzPSIiIGRhdGEtb2xkX2NvbG9yPSIjQzk5NTFCIj48L3BhdGg+PC9nPiA8L3N2Zz4="  style="
    width: 50%; "/> <p>Style Creator</p>
                                    
					<span class="badge badge-danger notification animated tada hidden"></span>
                                </a>
                                <a href="catalog.php" id="catalogPageBtn" class='btn btn-ghost-dark topNavBtn'>
								<img src="data:image/svg+xml;base64,
PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNTExLjk5OCA1MTEuOTk4IiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1MTEuOTk4IDUxMS45OTg7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNTEyIiBoZWlnaHQ9IjUxMiIgY2xhc3M9IiI+PGc+PGc+Cgk8Zz4KCQk8cGF0aCBkPSJNNDI3LjUyNiwzMS40OTFjMi42NSwyLjY1LDUuMjk1LDUuMjk0LDUuNzAxLDUuN2MtMC4yOTctMC4yOTctMS45My0xLjkzLTUuNzIxLTUuNzIxICAgIGMtOS45ODYtOS45ODUtNS4wMTQtNS4wMTMtMC4wMjEtMC4wMkM0MDcuNDg4LDExLjQ2MywzODIuNjU1LDAsMzU5LjM1LDBoLTEzLjM1MWMtNC4xNDIsMC03LjUsMy4zNTctNy41LDcuNXMzLjM1OCw3LjUsNy41LDcuNSAgICBoMTMuMzUxYzE5LjA4LDAsNDAuNTk0LDEwLjEyMiw1Ny41NSwyNy4wNzdjMTYuOTU4LDE2Ljk1NiwyNy4wODEsMzguNDcyLDI3LjA4MSw1Ny41NTV2MzQ2Ljg5OWwtNy41ODEsOS4zOHYtNjcuNjM4ICAgIGMwLTQuMTQzLTMuMzU4LTcuNS03LjUtNy41Yy00LjE0MiwwLTcuNSwzLjM1Ny03LjUsNy41djg2LjE5N2wtNy4xMjYsOC44MTdWMTIyLjY2MmMwLTQ1LjcyNi0zNy4yMDEtODIuOTI3LTgyLjkyNy04Mi45MjdIODMuODEyICAgIGw5LjkxNi03LjEyM2g1My4yNTZjNC4xNDIsMCw3LjUtMy4zNTcsNy41LTcuNXMtMy4zNTgtNy41LTcuNS03LjVoLTMyLjM3NUwxMTguMjQ2LDE1aDE5Mi44MzNjNC4xNDIsMCw3LjUtMy4zNTcsNy41LTcuNSAgICBzLTMuMzU4LTcuNS03LjUtNy41SDExNS44MzFjLTEuNTcsMC0zLjEwMSwwLjQ5My00LjM3NSwxLjQwOUw1Ni4xNDIsNDEuMTQ1Yy0xLjkzNSwxLjM5MS0zLjEyNSwzLjcwOC0zLjEyNSw2LjA5MXYyMDUuMjg2ICAgIGMwLDQuMTQzLDMuMzU4LDcuNSw3LjUsNy41YzQuMTQyLDAsNy41LTMuMzU3LDcuNS03LjVWNTQuNzM1aDI2My4zM2MzNy40NTUsMCw2Ny45MjcsMzAuNDcyLDY3LjkyNyw2Ny45Mjd2MzguMzU0ICAgIGMtMTQuMTYxLTAuOTE1LTI2LjIyNC0xMC41ODgtMzAuOTAyLTE0Ljg2N2MtMS43NDItMS41OTItNC4yMzQtMi4yODMtNi41NDktMS44MTdsLTUyLjE0OCwxMC41NSAgICBjLTIuNTEyLDAuNDg2LTQuOTc2LDEuNTQtNy40MDgsMi4zMjNjLTIwLjIyNiw2LjUxLTM2Ljk4MiwyMC4zNjEtNDcuMTgxLDM5LjAwMmwtMjUuNjg5LDQ2Ljk1NSAgICBjLTEuMDA1LDEuODM3LTEuMTk2LDQuMDExLTAuNTI3LDUuOTk1czIuMTM3LDMuNiw0LjA0OSw0LjQ1M2w1NS43MzIsMjQuODgyYzAuOTg2LDAuNDQsMi4wMjYsMC42NTIsMy4wNTUsMC42NTIgICAgYzIuMjUxLDAsNC40NDgtMS4wMTUsNS45MDUtMi44NzRsNS45NzEtNy42MTZ2ODcuODczYzAsNC4xNDMsMy4zNTgsNy41LDcuNSw3LjVjNC4xNDIsMCw3LjUtMy4zNTcsNy41LTcuNVYxNjguMzg1bDM4LjA5Ni03LjcwNyAgICBjMy45OTksMjAuNDQ3LDIxLjM2OCwzNi4xNTYsNDIuNTk2LDM3LjY0NnYyNTQuMzA1Yy00OC42OTYtMC4zMDUtNzIuOTEzLTEwLjkyMi04MC42OTItMTUuMTk2di01MS45NjFjMC00LjE0My0zLjM1OC03LjUtNy41LTcuNSAgICBjLTQuMTQyLDAtNy41LDMuMzU3LTcuNSw3LjV2NTYuMTE3YzAsMi4zMDksMS4wNjMsNC40ODgsMi44ODEsNS45MDljMS4wNDIsMC44MTQsMjYuMDM1LDE5LjczOCw5Mi44MTEsMjAuMTM1djI5LjM2NUg2OC4wMTcgICAgVjI4NS41MjZjMC00LjE0My0zLjM1OC03LjUtNy41LTcuNWMtNC4xNDIsMC03LjUsMy4zNTctNy41LDcuNXYyMTguOTcyYzAsNC4xNDMsMy4zNTgsNy41LDcuNSw3LjVoMzQ2LjI1NyAgICBjMi4yNDQsMCw0LjQxNy0xLjA1LDUuODMzLTIuNzg1bDQ0LjcwNy01NS4zMTRjMS4wNzktMS4zMzUsMS42NjctMi45OTksMS42NjctNC43MTVWOTkuNjMyICAgIEM0NTguOTgxLDc2LjMyMyw0NDcuNTE3LDUxLjQ4OSw0MjcuNTI2LDMxLjQ5MXogTTMwMy41NzksMjQ0LjM0N2wtMTQuMTYsMTguMDYybC00Mi45Ni0xOS4xOGwyMS43ODctMzkuODIyICAgIGM3Ljc5LTE0LjIzNiwyMC4yNTEtMjUuMDYsMzUuMzMzLTMwLjc3MlYyNDQuMzQ3eiBNMzk5LjI3NCwxODMuMjc4Yy02LjczOC0wLjY5OS0xMi44NTMtMy41MTgtMTcuNjc2LTcuNzcgICAgYzAuMDA5LDAuMDA0LDQuODIzLDQuMjUyLDAsMGMwLjAwOSwwLjAwNCwwLjAxOCwwLjAwOCwwLjAyNiwwLjAxMmMtMS4zOTYtMS4yMjYtMi42ODQtMi41NzItMy44NDktNC4wMiAgICBjLTAuMDk5LTAuMTIzLTAuODE0LTEuMDYtMS4wNjYtMS40MTFjLTAuMDY4LTAuMDk1LTAuMTM3LTAuMTktMC4yMDMtMC4yODZjNi41NTMsMy4yNiwxNC4zMTEsNS44NTksMjIuNzY4LDYuMjQxVjE4My4yNzh6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNEMkJGNTUiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3BhdGg+Cgk8L2c+CjwvZz48Zz4KCTxnPgoJCTxwYXRoIGQ9Ik0yNTMuMTg4LDExNy43OTlIMTAyLjczM2MtNC4xNDIsMC03LjUsMy4zNTctNy41LDcuNWMwLDQuMTQzLDMuMzU4LDcuNSw3LjUsNy41aDE1MC40NTVjNC4xNDIsMCw3LjUtMy4zNTcsNy41LTcuNSAgICBTMjU3LjMzLDExNy43OTksMjUzLjE4OCwxMTcuNzk5eiIgZGF0YS1vcmlnaW5hbD0iIzAwMDAwMCIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBzdHlsZT0iZmlsbDojRDJCRjU1IiBkYXRhLW9sZF9jb2xvcj0iIzAwMDAwMCI+PC9wYXRoPgoJPC9nPgo8L2c+PGc+Cgk8Zz4KCQk8cGF0aCBkPSJNMjUzLjE4OCwxNDMuNjg2SDEwMi43MzNjLTQuMTQyLDAtNy41LDMuMzU3LTcuNSw3LjVzMy4zNTgsNy41LDcuNSw3LjVoMTUwLjQ1NWM0LjE0MiwwLDcuNS0zLjM1Nyw3LjUtNy41ICAgIFMyNTcuMzMsMTQzLjY4NiwyNTMuMTg4LDE0My42ODZ6IiBkYXRhLW9yaWdpbmFsPSIjMDAwMDAwIiBjbGFzcz0iYWN0aXZlLXBhdGgiIHN0eWxlPSJmaWxsOiNEMkJGNTUiIGRhdGEtb2xkX2NvbG9yPSIjMDAwMDAwIj48L3BhdGg+Cgk8L2c+CjwvZz48Zz4KCTxnPgoJCTxwYXRoIGQ9Ik0xMzEuNDk2LDM2NS4wMTNoLTI4Ljc2M2MtNC4xNDIsMC03LjUsMy4zNTctNy41LDcuNXMzLjM1OCw3LjUsNy41LDcuNWgyOC43NjNjNC4xNDIsMCw3LjUtMy4zNTcsNy41LTcuNSAgICBTMTM1LjYzOCwzNjUuMDEzLDEzMS40OTYsMzY1LjAxM3oiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgc3R5bGU9ImZpbGw6I0QyQkY1NSIgZGF0YS1vbGRfY29sb3I9IiMwMDAwMDAiPjwvcGF0aD4KCTwvZz4KPC9nPjxnPgoJPGc+CgkJPHBhdGggZD0iTTIzMy42NDYsNDAxLjIyOEgxMDIuNzMzYy00LjE0MiwwLTcuNSwzLjM1Ny03LjUsNy41czMuMzU4LDcuNSw3LjUsNy41aDEzMC45MTNjNC4xNDIsMCw3LjUtMy4zNTcsNy41LTcuNSAgICBTMjM3Ljc4OCw0MDEuMjI4LDIzMy42NDYsNDAxLjIyOHoiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgc3R5bGU9ImZpbGw6I0QyQkY1NSIgZGF0YS1vbGRfY29sb3I9IiMwMDAwMDAiPjwvcGF0aD4KCTwvZz4KPC9nPjxnPgoJPGc+CgkJPHBhdGggZD0iTTIzMy42NDYsNDMwLjI1NUgxMDIuNzMzYy00LjE0MiwwLTcuNSwzLjM1Ny03LjUsNy41czMuMzU4LDcuNSw3LjUsNy41aDEzMC45MTNjNC4xNDIsMCw3LjUtMy4zNTcsNy41LTcuNSAgICBTMjM3Ljc4OCw0MzAuMjU1LDIzMy42NDYsNDMwLjI1NXoiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIGNsYXNzPSJhY3RpdmUtcGF0aCIgc3R5bGU9ImZpbGw6I0QyQkY1NSIgZGF0YS1vbGRfY29sb3I9IiMwMDAwMDAiPjwvcGF0aD4KCTwvZz4KPC9nPjwvZz4gPC9zdmc+"  style="
    width: 50%; " />
                                  <p> Catalog </p>
					<span class="badge badge-danger notification animated tada hidden"></span>
                                </a>
                                
                            </div>
                            <div class="row clientListPaneWrap" style="padding-left: 1%;">
                                <div class="col-md-12">
                                    <div id="clientListPane" class="row" style="display:none;">
                                        <div class="col-md-12 text-center">
                                            <div id="clientControls" style="margin-bottom: 10px;text-align:center;">
                                                <button id="addClientBtn" data-toggle="modal" href="#addClientModal" class="btn btn-ghost-dark dashboardBtn btn-success">
                                                    Add Client <i class="fa fa-plus"></i>
                                                </button>
                                                <a id="clientFormsBtn" data-toggle="modal" href="#clientFormModal" class="btn btn-ghost-dark full dashboardBtn btn-success">
                                                    Client Form

                                                    <!--<span class="badge badge-danger notification animated tada" style="top: -6px;color: white;left: -4px;font-size: 8px;letter-spacing: 1px;box-shadow: none;line-height: 16px;height: 14px;">NEW</span> -->
                                                    <i class="fa fa-file-text-o"></i>
                                                </a>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div id="clearTableFilters" class="alert alert-info" style="display:none;"></div>
                                            <!--<pre>
								array(2) {
  ["Closet"]=>
  array(18) {
    ["id"]=>
    string(5) "21256"
    ["user_id"]=>
    string(3) "102"
    ["client_id"]=>
    string(4) "7040"
    ["slug"]=>
    string(10) "102H&S8bCX"
    ["show_closet"]=>
    string(1) "0"
    ["show_lookbook"]=>
    string(1) "0"
    ["show_uploads"]=>
    string(1) "1"
    ["comments_disabled"]=>
    string(1) "0"
    ["is_stickied"]=>
    string(1) "0"
    ["sticky_date"]=>
    NULL
    ["position"]=>
    string(1) "0"
    ["has_password"]=>
    string(1) "0"
    ["password"]=>
    NULL
    ["title"]=>
    NULL
    ["header_image"]=>
    NULL
    ["description"]=>
    NULL
    ["created"]=>
    string(19) "2017-10-22 12:42:38"
    ["modified"]=>
    string(19) "2017-10-22 12:42:38"
  }
  ["Client"]=>
  array(32) {
    ["id"]=>
    string(4) "7040"
    ["user_id"]=>
    string(3) "102"
    ["unique_code"]=>
    string(10) "102H&S8bCX"
    ["intake_form_id"]=>
    NULL
    ["email"]=>
    string(23) "burodeestilo@icloud.com"
    ["first_name"]=>
    string(7) "EDUARDO"
    ["last_name"]=>
    string(9) "FERNANDEZ"
    ["birthday"]=>
    string(10) "10/10/1973"
    ["anniversary"]=>
    string(0) ""
    ["follow_up_date"]=>
    NULL
    ["height"]=>
    string(0) ""
    ["age"]=>
    string(2) "44"
    ["sex"]=>
    string(9) "MASCULINO"
    ["phone"]=>
    string(0) ""
    ["shoe_size"]=>
    string(2) "10"
    ["pant_inseam"]=>
    string(0) ""
    ["bust"]=>
    string(0) ""
    ["waist"]=>
    string(0) ""
    ["hips"]=>
    NULL
    ["descriptive_words"]=>
    string(0) ""
    ["body_shape"]=>
    string(1) "0"
    ["face_shape"]=>
    string(1) "0"
    ["street_address"]=>
    string(12) "GUTENBERG 85"
    ["city"]=>
    string(17) "Ciudad de México"
    ["state"]=>
    string(7) "México"
    ["zipcode"]=>
    string(5) "11560"
    ["country"]=>
    string(7) "México"
    ["notes"]=>
    string(126) "1. Necesito asesoría en la compra del tipo de pantalones casuales
2. Tipo de corbatas que puedo usar para combinar con sacos"
    ["stripe_cust_id"]=>
    NULL
    ["platform_stripe_cust_id"]=>
    NULL
    ["created"]=>
    string(19) "2017-10-22 12:42:38"
    ["modified"]=>
    string(19) "2017-10-22 12:50:26"
  }
}
							</pre>-->
							
                                    </div>
                                    <div id="clientDetailsPane" class="container-fluid" style="display:none;"></div>
                                </div>
                            </div>
                            <div class="row catalogListPaneWrap">
                                <div class="col-md-12">
                                    <div id="catalogListPane" class="row" style="display:none;">
                                        <div class="col-md-12 text-center">
                                            <div id="catalogControls" style="margin-bottom: 10px;text-align:center;">
                                                <button id="addCatalogBtn" data-toggle="modal" href="#addCatalogModal" class="btn btn-ghost-dark full dashboardBtn btn-success" style="width:200px;">
                                                    Add Catalog <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div id="clearCatalogTableFilters" class="alert alert-info" style="display:none;"></div>
                                            <!--<pre>
								array(2) {
  ["Closet"]=>
  array(18) {
    ["id"]=>
    string(5) "21256"
    ["user_id"]=>
    string(3) "102"
    ["client_id"]=>
    string(4) "7040"
    ["slug"]=>
    string(10) "102H&S8bCX"
    ["show_closet"]=>
    string(1) "0"
    ["show_lookbook"]=>
    string(1) "0"
    ["show_uploads"]=>
    string(1) "1"
    ["comments_disabled"]=>
    string(1) "0"
    ["is_stickied"]=>
    string(1) "0"
    ["sticky_date"]=>
    NULL
    ["position"]=>
    string(1) "0"
    ["has_password"]=>
    string(1) "0"
    ["password"]=>
    NULL
    ["title"]=>
    NULL
    ["header_image"]=>
    NULL
    ["description"]=>
    NULL
    ["created"]=>
    string(19) "2017-10-22 12:42:38"
    ["modified"]=>
    string(19) "2017-10-22 12:42:38"
  }
  ["Client"]=>
  array(32) {
    ["id"]=>
    string(4) "7040"
    ["user_id"]=>
    string(3) "102"
    ["unique_code"]=>
    string(10) "102H&S8bCX"
    ["intake_form_id"]=>
    NULL
    ["email"]=>
    string(23) "burodeestilo@icloud.com"
    ["first_name"]=>
    string(7) "EDUARDO"
    ["last_name"]=>
    string(9) "FERNANDEZ"
    ["birthday"]=>
    string(10) "10/10/1973"
    ["anniversary"]=>
    string(0) ""
    ["follow_up_date"]=>
    NULL
    ["height"]=>
    string(0) ""
    ["age"]=>
    string(2) "44"
    ["sex"]=>
    string(9) "MASCULINO"
    ["phone"]=>
    string(0) ""
    ["shoe_size"]=>
    string(2) "10"
    ["pant_inseam"]=>
    string(0) ""
    ["bust"]=>
    string(0) ""
    ["waist"]=>
    string(0) ""
    ["hips"]=>
    NULL
    ["descriptive_words"]=>
    string(0) ""
    ["body_shape"]=>
    string(1) "0"
    ["face_shape"]=>
    string(1) "0"
    ["street_address"]=>
    string(12) "GUTENBERG 85"
    ["city"]=>
    string(17) "Ciudad de México"
    ["state"]=>
    string(7) "México"
    ["zipcode"]=>
    string(5) "11560"
    ["country"]=>
    string(7) "México"
    ["notes"]=>
    string(126) "1. Necesito asesoría en la compra del tipo de pantalones casuales
2. Tipo de corbatas que puedo usar para combinar con sacos"
    ["stripe_cust_id"]=>
    NULL
    ["platform_stripe_cust_id"]=>
    NULL
    ["created"]=>
    string(19) "2017-10-22 12:42:38"
    ["modified"]=>
    string(19) "2017-10-22 12:50:26"
  }
}
							</pre>-->
                                            <table id="catalogTable" class="table table-condensed table-list-search unselectable" style="margin-top:10px;">
                                                <thead>
                                                    <tr class="catalogRow">
                                                        <th class="no-sort">
                                                            <span></span>
                                                        </th>
                                                        <th>
                                                            <span>
                                                                Catalog<i class="fa fa-caret-down"></i>
                                                            </span>
                                                        </th>
                                                        <th class="hidden-xs" style="width:100px;">
                                                            <span>
                                                                Tools<i class="fa fa-caret-down"></i>
                                                            </span>
                                                        </th>
                                                        <th class="hidden-xs" style="width:140px;" data-sorter="shortDate" data-date-format="mm-dd-yyyy">
                                                            <span>
                                                                Created<i class="fa fa-caret-down"></i>
                                                            </span>
                                                        </th>
                                                        <th class="hidden"></th>
                                                        <th class="hidden-md-sm hidden-sm hidden-xs no-sort" style="width:100px;">
                                                            <span></span>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <!-- -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row earningsPaneWrap">
                                <div class="col-md-12">
                                    <div id="earningsPane" class="row" style="display:none;">
                                        <div class="col-md-4" style="padding-right:0;margin-bottom:20px;">
                                            <div style="height:555px;border:none;">
                                                <h1 style="text-align:center;margin: 0 0px;border-radius: 2px;padding: 17px 0 7px;background-color: #121212;color: white;">Earnings:
								</h1>
                                                <div class="earningsSection" style="background:white;background-color: #4CC397;color: white;text-shadow: 0 0 7px rgba(0, 0, 0, 0.26);">
                                                    <i class="fa fa-dollar"></i>
                                                    <label>
                                                        Newly Locked Commission
										<br/>
                                                        <span>Earnings that will be applied to your upcoming pay period</span>
                                                    </label>
                                                    <br/>
                                                    <span style="font-size:28px;font-weight:bold;">$198.30</span>
                                                </div>
                                                <div class="earningsSection" style="background-color: #FFF;">
                                                    <i class="fa fa-unlock-alt"></i>
                                                    <label>
                                                        Unlocked Commission
										<br/>
                                                        <span>
                                                            Earnings from purchases that may be returned <span style="white-space: nowrap;">(not yet 90 days old)</span>
                                                        </span>
                                                    </label>
                                                    <br/>
                                                    <span style="font-size:28px;font-weight:bold;">$0.96</span>
                                                </div>
                                                <div class="earningsSection">
                                                    <i class="fa fa-lock"></i>
                                                    <label>
                                                        Locked Commission
										<br/>
                                                        <span>
                                                            Commission from locked purchases (made before <span style="white-space: nowrap;">December 19, 2017</span>
                                                            )
                                                        </span>
                                                    </label>
                                                    <br/>
                                                    <span style="font-size:28px;font-weight:bold;">$198.30</span>
                                                </div>
                                                <div class="earningsSection">
                                                    <i class="fa fa-bank" style="background-color: rgba(0, 0, 0, 0.39);font-size: 32px;"></i>
                                                    <label>
                                                        All Commission
										<br/>
                                                        <span>Commission from all purchases (including new, unlocked, and paid-out purchases)</span>
                                                    </label>
                                                    <br/>
                                                    <span style="font-size:28px;font-weight:bold;">$199.26</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8" style="padding-right:0;margin-bottom:20px;">
                                            <div class="panel" style="background:white;border:none;margin:0;">
                                                <div class="text-center" style="height:35px;z-index:2;position:relative;top:3px;">
                                                    <button class="btn btn-xs btn-ghost-dark graphRangeBtn" data-unit="all" id="chartMonthlyBtn">All</button>
                                                    <button class="btn btn-xs btn-ghost-dark graphRangeBtn" data-unit="month" id="chartMonthlyBtn">12 Month</button>
                                                    <button class="btn btn-xs btn-ghost-dark graphRangeBtn" data-unit="week" id="chartWeeklyBtn">12 Week</button>
                                                    <button class="btn btn-xs btn-ghost-dark graphRangeBtn active" data-unit="day" id="chartDailyBtn">30 Day</button>
                                                </div>
                                                <div id="chartContainer" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                                                <div style="display:table;height:120px;background: #E5E5E5;padding: 14px 10px 5px; font-style: italic; color: #5A5A5A; font-size: 13px; text-align: center; margin-top:0px;">
                                                    <div style="display:table-cell;vertical-align:middle;">
                                                        <b>Commission earned before December 19, 2017 is locked!</b>
                                                        <p>Retailers allow 90 days for returns before paying out commission. Once commission is received by A Creative Cliche,
											it will be first applied to any upcoming charge.  If earnings during a period exceed the upcoming charge,
											the remainder will be direct deposited into an account of your choice!
										</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8" style="padding-right:0;">
                                            <div class="panel" style="padding:0 20px 10px;">
                                                <div>
                                                    <p class="reportDate">January 04, 2018</p>
                                                    <div class='well commissionReportWrap' style='background:white;padding:0;'>
                                                        <table class='table commissionReportTable' style='font-size:13px;margin:0;'>
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <i class="fa fa-unlock-alt"></i>
                                                                    </td>
                                                                    <td>
                                                                        <b style='color:#7E7E7E'>$0.96</b>
                                                                    </td>
                                                                    <td class="text-muted" data-retailer="Unknown Retailer">
                                                                        <i>Unknown Retailer</i>
                                                                    </td>
                                                                    <td class="text-muted" data-cuid="HS_102_social">Social Media</td>
                                                                    <td class="text-muted" style="padding-top:13px">2018/01/04</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <p class="reportDate">June 15, 2017</p>
                                                    <div class='well commissionReportWrap' style='background:white;padding:0;'>
                                                        <table class='table commissionReportTable' style='font-size:13px;margin:0;'>
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <i class="fa fa-lock"></i>
                                                                    </td>
                                                                    <td>
                                                                        <b style='color:#6BB323'>$95.05</b>
                                                                    </td>
                                                                    <td class="text-muted" data-retailer="m.shop.nordstrom.com">M.shop.nordstrom.com</td>
                                                                    <td class="text-muted" data-cuid="HS_102_n_14192_ext349718">
                                                                        <a href='/closet/102H%26SWVxc'>Emma Rock</a>
                                                                    </td>
                                                                    <td class="text-muted" style="padding-top:13px">2017/06/15</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <p class="reportDate">March 25, 2017</p>
                                                    <div class='well commissionReportWrap' style='background:white;padding:0;'>
                                                        <table class='table commissionReportTable' style='font-size:13px;margin:0;'>
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <i class="fa fa-lock"></i>
                                                                    </td>
                                                                    <td>
                                                                        <b style='color:#6BB323'>$4.5</b>
                                                                    </td>
                                                                    <td class="text-muted" data-retailer="shop.nordstrom.com">Shop.nordstrom.com</td>
                                                                    <td class="text-muted" data-cuid="HS_102_n_14192_ext287661">
                                                                        <a href='/closet/102H%26SWVxc'>Emma Rock</a>
                                                                    </td>
                                                                    <td class="text-muted" style="padding-top:13px">2017/03/25</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <i class="fa fa-lock"></i>
                                                                    </td>
                                                                    <td>
                                                                        <b style='color:#6BB323'>$4.5</b>
                                                                    </td>
                                                                    <td class="text-muted" data-retailer="shop.nordstrom.com">Shop.nordstrom.com</td>
                                                                    <td class="text-muted" data-cuid="HS_102_n_14192_ext287661">
                                                                        <a href='/closet/102H%26SWVxc'>Emma Rock</a>
                                                                    </td>
                                                                    <td class="text-muted" style="padding-top:13px">2017/03/25</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <p class="reportDate">March 02, 2017</p>
                                                    <div class='well commissionReportWrap' style='background:white;padding:0;'>
                                                        <table class='table commissionReportTable' style='font-size:13px;margin:0;'>
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <i class="fa fa-lock"></i>
                                                                    </td>
                                                                    <td>
                                                                        <b style='color:#6BB323'>$8.43</b>
                                                                    </td>
                                                                    <td class="text-muted" data-retailer="shop.nordstrom.com">Shop.nordstrom.com</td>
                                                                    <td class="text-muted" data-cuid="HS_102_n_14192_ext265020">
                                                                        <a href='/closet/102H%26SWVxc'>Emma Rock</a>
                                                                    </td>
                                                                    <td class="text-muted" style="padding-top:13px">2017/03/02</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <i class="fa fa-lock"></i>
                                                                    </td>
                                                                    <td>
                                                                        <b style='color:#6BB323'>$8.43</b>
                                                                    </td>
                                                                    <td class="text-muted" data-retailer="shop.nordstrom.com">Shop.nordstrom.com</td>
                                                                    <td class="text-muted" data-cuid="HS_102_n_14192_ext265020">
                                                                        <a href='/closet/102H%26SWVxc'>Emma Rock</a>
                                                                    </td>
                                                                    <td class="text-muted" style="padding-top:13px">2017/03/02</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <p class="reportDate">May 03, 2016</p>
                                                    <div class='well commissionReportWrap' style='background:white;padding:0;'>
                                                        <table class='table commissionReportTable' style='font-size:13px;margin:0;'>
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <i class="fa fa-lock"></i>
                                                                    </td>
                                                                    <td>
                                                                        <b style='color:#6BB323'>$20.93</b>
                                                                    </td>
                                                                    <td class="text-muted" data-retailer="Unknown Retailer">
                                                                        <i>Unknown Retailer</i>
                                                                    </td>
                                                                    <td class="text-muted" data-cuid="HS_102_n_11676_718458">
                                                                        <a href='/closet/102H%26SWVxc'>Emma Rock</a>
                                                                    </td>
                                                                    <td class="text-muted" style="padding-top:13px">2016/05/03</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <p class="reportDate">December 14, 2015</p>
                                                    <div class='well commissionReportWrap' style='background:white;padding:0;'>
                                                        <table class='table commissionReportTable' style='font-size:13px;margin:0;'>
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <i class="fa fa-lock"></i>
                                                                    </td>
                                                                    <td>
                                                                        <b style='color:#6BB323'>$5.63</b>
                                                                    </td>
                                                                    <td class="text-muted" data-retailer="shop.nordstrom.com">Shop.nordstrom.com</td>
                                                                    <td class="text-muted" data-cuid="HS_102__803_ext10566">
                                                                        <a href='/closet/102H%26S51FP'>Your New Online Closet</a>
                                                                    </td>
                                                                    <td class="text-muted" style="padding-top:13px">2015/12/14</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <p class="reportDate">May 22, 2015</p>
                                                    <div class='well commissionReportWrap' style='background:white;padding:0;'>
                                                        <table class='table commissionReportTable' style='font-size:13px;margin:0;'>
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <i class="fa fa-lock"></i>
                                                                    </td>
                                                                    <td>
                                                                        <b style='color:#6BB323'>$15.99</b>
                                                                    </td>
                                                                    <td class="text-muted" data-retailer="Unknown Retailer">
                                                                        <i>Unknown Retailer</i>
                                                                    </td>
                                                                    <td class="text-muted" data-cuid="HS_102_n_s_619447">
                                                                        <i>Unknown Link</i>
                                                                    </td>
                                                                    <td class="text-muted" style="padding-top:13px">2015/05/22</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <p class="reportDate">April 14, 2015</p>
                                                    <div class='well commissionReportWrap' style='background:white;padding:0;'>
                                                        <table class='table commissionReportTable' style='font-size:13px;margin:0;'>
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <i class="fa fa-lock"></i>
                                                                    </td>
                                                                    <td>
                                                                        <b style='color:#6BB323'>$0.42</b>
                                                                    </td>
                                                                    <td class="text-muted" data-retailer="Unknown Retailer">
                                                                        <i>Unknown Retailer</i>
                                                                    </td>
                                                                    <td class="text-muted" data-cuid="HS_102_1517_58_396057">
                                                                        <a href='/closet/102H%26SU1NU'>Alice Smith</a>
                                                                    </td>
                                                                    <td class="text-muted" style="padding-top:13px">2015/04/14</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <p class="reportDate">March 15, 2015</p>
                                                    <div class='well commissionReportWrap' style='background:white;padding:0;'>
                                                        <table class='table commissionReportTable' style='font-size:13px;margin:0;'>
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <i class="fa fa-lock"></i>
                                                                    </td>
                                                                    <td>
                                                                        <b style='color:#6BB323'>$0.9</b>
                                                                    </td>
                                                                    <td class="text-muted" data-retailer="Unknown Retailer">
                                                                        <i>Unknown Retailer</i>
                                                                    </td>
                                                                    <td class="text-muted" data-cuid="HS_102_unknown">
                                                                        <i>Unknown Link</i>
                                                                    </td>
                                                                    <td class="text-muted" style="padding-top:13px">2015/03/15</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <p class="reportDate">March 01, 2015</p>
                                                    <div class='well commissionReportWrap' style='background:white;padding:0;'>
                                                        <table class='table commissionReportTable' style='font-size:13px;margin:0;'>
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <i class="fa fa-lock"></i>
                                                                    </td>
                                                                    <td>
                                                                        <b style='color:#6BB323'>$0.34</b>
                                                                    </td>
                                                                    <td class="text-muted" data-retailer="Unknown Retailer">
                                                                        <i>Unknown Retailer</i>
                                                                    </td>
                                                                    <td class="text-muted" data-cuid="HS_102_unknown">
                                                                        <i>Unknown Link</i>
                                                                    </td>
                                                                    <td class="text-muted" style="padding-top:13px">2015/03/01</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <p class="reportDate">February 15, 2015</p>
                                                    <div class='well commissionReportWrap' style='background:white;padding:0;'>
                                                        <table class='table commissionReportTable' style='font-size:13px;margin:0;'>
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <i class="fa fa-lock"></i>
                                                                    </td>
                                                                    <td>
                                                                        <b style='color:#6BB323'>$0.68</b>
                                                                    </td>
                                                                    <td class="text-muted" data-retailer="Unknown Retailer">
                                                                        <i>Unknown Retailer</i>
                                                                    </td>
                                                                    <td class="text-muted" data-cuid="HS_102_unknown">
                                                                        <i>Unknown Link</i>
                                                                    </td>
                                                                    <td class="text-muted" style="padding-top:13px">2015/02/15</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <p class="reportDate">October 13, 2014</p>
                                                    <div class='well commissionReportWrap' style='background:white;padding:0;'>
                                                        <table class='table commissionReportTable' style='font-size:13px;margin:0;'>
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <i class="fa fa-lock"></i>
                                                                    </td>
                                                                    <td>
                                                                        <b style='color:#6BB323'>$32.54</b>
                                                                    </td>
                                                                    <td class="text-muted" data-retailer="Unknown Retailer">
                                                                        <i>Unknown Retailer</i>
                                                                    </td>
                                                                    <td class="text-muted" data-cuid="HS_102_n_58_428580">
                                                                        <a href='/closet/102H%26SU1NU'>Alice Smith</a>
                                                                    </td>
                                                                    <td class="text-muted" style="padding-top:13px">2014/10/13</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4" style="padding-right:0;">
                                            <div class="panel text-center" style="background:white;">
                                                <h3 class="text-center">Past Payouts</h3>
                                                <p>
                                                    <i>You have not yet received a commission payout!</i>
                                                </p>
                                                <p style="background-color:#E5E5E5; margin:0;padding:10px;border-top:1px solid #DBDBDB;">
                                                    <i>Your commission earnings are first applied to your upcoming payment.</i>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
<div class="row menswearPaneWrap" style="">
    <div id="menswearPane" class="row" style="display:none;">
        <div class="col-lg-2 col-sm-3 hidden-xs" style="min-height: 100%;margin-bottom:20px;background: #272727;padding: 10px 0px;position: absolute;top: 0;bottom: 0;">
            <button id="createNewOrderBtn" class="btn btn-ghost-dark full dashboardBtn btn-success" data-toggle="modal" href="#selectClientModal" style="width:95%;padding: 11px 2px 12px;margin: 0 auto 10px;max-width: 230px;display: block;float: none;font-size: 18px;">
                New Order <i class="fa fa-plus" style="float: right;margin-right: 10px;padding-left: 4px;"></i>
            </button>
            <nav>
                <ul class="darkMenu">
                    <li>
                        <a href="#orderHistoryTab" data-toggle="tab">
                            <i class="fa fa-list"></i>
                            Orders
                        </a>
                    </li>
                    <li>
                        <a href="#newsTab" data-toggle="tab">
                            <i class="fa fa-bullhorn"></i>
                            <span class="hidden-lg hidden-sm">What's New</span>
                            <span class="visible-lg visible-sm">News</span>
                        </a>
                    </li>
                    <li>
                        <a href="#pricingTab" data-toggle="tab">
                            <i class="fa fa-dollar"></i>
                            Pricing
                        </a>
                    </li>
                    <li>
                        <a href="#trainingTab" data-toggle="tab">
                            <i class="fa fa-mortar-board"></i>
                            Training
                        </a>
                    </li>
                    <li>
                        <a href="#strategiesTab" data-toggle="tab">
                            <i class="fa fa-suitcase"></i>
                            Coaching
                        </a>
                    </li>
                    <li>
                        <a href="#programTab" data-toggle="tab">
                            <i class="fa fa-cogs"></i>
                            Program
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="col-md-7 col-lg-8 col-sm-9 col-sm-push-3 col-lg-push-2 col-md-push-3" style="background:#FFF url(/img/vendors/hmcole/HM_Cole_Measuring.jpg) 50% 0px / 100% no-repeat;">
            <div class="visible-xs" style="margin: 5px -10px;position: relative;top: 230px;">
                <nav>
                    <ul style="" class="darkTabMenu">
                        <li>
                            <a href="#orderHistoryTab" data-toggle="tab">
                                <i class="fa fa-list"></i>
                                Orders
                            </a>
                        </li>
                        <li>
                            <a href="#newsTab" data-toggle="tab">
                                <i class="fa fa-bullhorn"></i>
                                News
                            </a>
                        </li>
                        <li>
                            <a href="#pricingTab" data-toggle="tab">
                                <i class="fa fa-dollar"></i>
                                Pricing
                            </a>
                        </li>
                        <li>
                            <a href="#trainingTab" data-toggle="tab">
                                <i class="fa fa-mortar-board"></i>
                                Training
                            </a>
                        </li>
                        <li>
                            <a href="#strategiesTab" data-toggle="tab">
                                <i class="fa fa-suitcase" style=""></i>
                                Coaching
                            </a>
                        </li>
                        <li>
                            <a href="#programTab" data-toggle="tab">
                                <i class="fa fa-cogs" style=""></i>
                                Program
                            </a>
                        </li>
                    </ul>
                </nav>
                <button id="createNewOrderBtn" class="btn btn-ghost-dark full dashboardBtn btn-success" data-toggle="modal" href="#selectClientModal" style="width: 100%;padding: 11px 2px 12px;margin: 5px auto 0px;max-width: 230px;display: block;float: none;font-size: 18px;">
                    New Order <i class="fa fa-plus" style="float: right;margin-right: 10px;padding-left: 4px;"></i>
                </button>
            </div>
            <!--
						<div class="tabs tabs-style-linetriangle" style="background:white;">
								<ul id="closetNav">
									<li id="findsTabBtn" class="" style="max-width:160px;"><a href="#resourcesTab" data-toggle="tab"><span><i class="fa fa-dollar" style="font-size:23px;"></i> News</span></a></li>
									<li id="findsTabBtn" style="max-width:160px;" class="active"><a href="#orderHistoryTab" data-toggle="tab"><span><i class="fa fa-list" style="font-size:23px;"></i> Orders</span></a></li>
									<li id="findsTabBtn" style="max-width:160px;" class=""><a href="#strategiesTab" data-toggle="tab"><span><i class="fa fa-dollar" style="font-size:23px;"></i> Resources</span></a></li>
								</ul>

							<div class="row loadingPaneWrap">
								<div class="col-md-12">

									<div id="loadingPane" class="row" style="display: none;">
										<h1 style="color:white;margin: 5vh 0;text-align: center;">Loading Dashboard...</h1>
									</div>

								</div>
							</div>
						</div>
						-->
            <div style="border:none;margin:0 0 20px;text-align: center;padding:220px 0 0;">
                <div class="tab-content">
                    <div class="tab-pane fade" id="orderHistoryTab" style="min-height:400px;padding-top:25px;">
                        <h1>Order History</h1>
                        <div id="orderControls" style="margin-bottom: 10px;text-align:center;">
                            <select name="sortOrdersBy" id="sortOrdersBy" class="form-control" style="border:none;box-shadow: 0 2px 6px -2px #000;border-radius: 1px;">
                                <option value="_none_">Sort By...</option>
                                <option value="created_desc" selected="selected">Date Created</option>
                                <!--
											<option value="due_desc">Date Due</option>
											<option value="last_name_desc">Last Name Ascending</option>
											<option value="last_name_desc">Last Name Descending</option>
											<option value="first_name_asc">First Name Ascending</option>
											<option value="first_name_desc">First Name Descending</option>
											-->
                            </select>
                        </div>
                        <div class="clearfix"></div>
                        <div id="clearOrderTableFilters" class="alert alert-info" style="display:none;"></div>
                        <!--<pre>
										array(2) {
  ["Closet"]=>
  array(18) {
    ["id"]=>
    string(5) "21256"
    ["user_id"]=>
    string(3) "102"
    ["client_id"]=>
    string(4) "7040"
    ["slug"]=>
    string(10) "102H&S8bCX"
    ["show_closet"]=>
    string(1) "0"
    ["show_lookbook"]=>
    string(1) "0"
    ["show_uploads"]=>
    string(1) "1"
    ["comments_disabled"]=>
    string(1) "0"
    ["is_stickied"]=>
    string(1) "0"
    ["sticky_date"]=>
    NULL
    ["position"]=>
    string(1) "0"
    ["has_password"]=>
    string(1) "0"
    ["password"]=>
    NULL
    ["title"]=>
    NULL
    ["header_image"]=>
    NULL
    ["description"]=>
    NULL
    ["created"]=>
    string(19) "2017-10-22 12:42:38"
    ["modified"]=>
    string(19) "2017-10-22 12:42:38"
  }
  ["Client"]=>
  array(32) {
    ["id"]=>
    string(4) "7040"
    ["user_id"]=>
    string(3) "102"
    ["unique_code"]=>
    string(10) "102H&S8bCX"
    ["intake_form_id"]=>
    NULL
    ["email"]=>
    string(23) "burodeestilo@icloud.com"
    ["first_name"]=>
    string(7) "EDUARDO"
    ["last_name"]=>
    string(9) "FERNANDEZ"
    ["birthday"]=>
    string(10) "10/10/1973"
    ["anniversary"]=>
    string(0) ""
    ["follow_up_date"]=>
    NULL
    ["height"]=>
    string(0) ""
    ["age"]=>
    string(2) "44"
    ["sex"]=>
    string(9) "MASCULINO"
    ["phone"]=>
    string(0) ""
    ["shoe_size"]=>
    string(2) "10"
    ["pant_inseam"]=>
    string(0) ""
    ["bust"]=>
    string(0) ""
    ["waist"]=>
    string(0) ""
    ["hips"]=>
    NULL
    ["descriptive_words"]=>
    string(0) ""
    ["body_shape"]=>
    string(1) "0"
    ["face_shape"]=>
    string(1) "0"
    ["street_address"]=>
    string(12) "GUTENBERG 85"
    ["city"]=>
    string(17) "Ciudad de México"
    ["state"]=>
    string(7) "México"
    ["zipcode"]=>
    string(5) "11560"
    ["country"]=>
    string(7) "México"
    ["notes"]=>
    string(126) "1. Necesito asesoría en la compra del tipo de pantalones casuales
2. Tipo de corbatas que puedo usar para combinar con sacos"
    ["stripe_cust_id"]=>
    NULL
    ["platform_stripe_cust_id"]=>
    NULL
    ["created"]=>
    string(19) "2017-10-22 12:42:38"
    ["modified"]=>
    string(19) "2017-10-22 12:50:26"
  }
}
									</pre>-->
                        <table id="orderTable" class="table table-condensed table-list-search unselectable">
                            <thead>
                                <tr class="invoiceRow hidden">
                                    <th class="hidden-xs" style="width:250px;">
                                        <span>
                                            Status<i class="fa fa-caret-down"></i>
                                        </span>
                                    </th>
                                    <th class="invoiceTotalCol hidden-xs">
                                        <span>
                                            Total<i class="fa fa-caret-down"></i>
                                        </span>
                                    </th>
                                    <th class="hidden-xs">
                                        <span>
                                            First Name<i class="fa fa-caret-down"></i>
                                        </span>
                                    </th>
                                    <th class="hidden-xs">
                                        <span>
                                            Last Name<i class="fa fa-caret-down"></i>
                                        </span>
                                    </th>
                                    <th class="hidden-xs">
                                        <span>
                                            Created<i class="fa fa-caret-down"></i>
                                        </span>
                                    </th>
                                    <th class="hidden-xs">
                                        <span>
                                            Due<i class="fa fa-caret-down"></i>
                                        </span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade active in" id="welcomeTab" style="min-height:400px;padding-top:25px;">
                        <h1>Welcome From H.M. Cole</h1>
                        <div class="panel">
                            <p>A warm welcome from all of us at H.M. Cole!
										</p>
                            <p>Being an H.M. Cole clothier is a rewarding and prestigious role.  Apart from growing your own business and earning competitive
										commissions, you will delight clients and foster long-term relationships that will last for years to come.

										</p>
                            <p>
                                Please familiarize yourself with the helpful resources available in this A Creative Cliche portal. The '<em>Training</em>
                                ' tab contains information
										that will help you become an expert H.M. Cole clothier in no time.  Watch the '<em>What's New</em>
                                ' tab for updates from us.  Finally, look
										for emails and content added to the '<em>Coaching</em>
                                ' tab for ideas and strategies for growing your business with H.M. Cole.

                            </p>
                            <p>We are committed to helping you be successful in this exciting opportunity.
										</p>
                            <h3>OUR BEGINNINGS:</h3>
                            <p>Founded on the belief that custom clothing should be luxurious in both product and experience, H.M. Cole is continuously
										innovating the way custom clothing is ordered, delivered, and manufactured. The initial concept for H.M. Cole was born in late 2010
										and has grown to be a nationwide brand with clientele ranging from top Fortune 500 executives, professional athletes, and even
										some of the top recording artists of all time. We have been featured in top publications such as Forbes, Inc, and USA Today as
										specialists in convenience and customer experience.
										</p>
                            <h3>WHY WE ARE DIFFERENT:</h3>
                            <ul>
                                <li>H.M. Cole only deals in hand-cut, hand-delivered clothing. We say no to machines and yes to quality materials.</li>
                                <li>H.M. Cole clients are introduced to unique visual and educational concepts at each consultation. We seek to create a rewarding experience from consultation to delivery.</li>
                                <li>H.M. Cole does not outsource to large, made-to-measure factories. Rather, we control our manufacturing. This allows our clients to receive their garments in exceptionally short timelines with unsurpassed quality and value.</li>
                            </ul>
                            <p>We look forward to working with you to supply your clientele with the best custom apparel available!
										</p>
                            <img src="/img/vendors/hmcole/signature.png" style="margin:20px auto;max-width: 360px;width: 100%;padding: 0 20px;"/>
                            <p>
                                Michael B. McConkie<br/>
                                Co-Founder<br/>H.M. Cole

                            </p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="newsTab" style="min-height:400px;padding-top:25px;">
                        <h1>Welcome From H.M. Cole</h1>
                        <div class="panel">
                            <p>A warm welcome from all of us at H.M. Cole!
										</p>
                            <p>Being an H.M. Cole clothier is a rewarding and prestigious role.  Apart from growing your own business and earning competitive
										commissions, you will delight clients and foster long-term relationships that will last for years to come.

										</p>
                            <p>
                                Please familiarize yourself with the helpful resources availablein this A Creative Cliche portal. The '<em>Training</em>
                                ' tab contains information
										that will help you become an expert H.M. Cole clothier in no time.  Watch the '<em>What's New</em>
                                ' tab for updates from us.  Finally, look
										for emails and content added to the '<em>Coaching</em>
                                ' tab for ideas and strategies for growing your business with H.M. Cole.

                            </p>
                            <p>We are committed to helping you be successful in this exciting opportunity.
										</p>
                            <h3>OUR BEGINNINGS:</h3>
                            <p>Founded on the belief that custom clothing should be luxurious in both product and experience, H.M. Cole is continuously
										innovating the way custom clothing is ordered, delivered, and manufactured. The initial concept for H.M. Cole was born in late 2010
										and has grown to be a nationwide brand with clientele ranging from top Fortune 500 executives, professional athletes, and even
										some of the top recording artists of all time. We have been featured in top publications such as Forbes, Inc, and USA Today as
										specialists in convenience and customer experience.
										</p>
                            <h3>WHY WE ARE DIFFERENT:</h3>
                            <ul>
                                <li>H.M. Cole only deals in hand-cut, hand-delivered clothing. We say no to machines and yes to quality materials.</li>
                                <li>H.M. Cole clients are introduced to unique visual and educational concepts at each consultation. We seek to create a rewarding experience from consultation to delivery.</li>
                                <li>H.M. Cole does not outsource to large, made-to-measure factories. Rather, we control our manufacturing. This allows our clients to receive their garments in exceptionally short timelines with unsurpassed quality and value.</li>
                            </ul>
                            <p>We look forward to working with you to supply your clientele with the best custom apparel available!
										</p>
                            <img src="/img/vendors/hmcole/signature.png" style="margin:20px auto;max-width: 360px;width: 100%;padding: 0 20px;"/>
                            <p>
                                Michael B. McConkie<br/>
                                Co-Founder<br/>H.M. Cole

                            </p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pricingTab" style="min-height:400px;padding-top:25px;">
                        <h1>Pricing Information</h1>
                        <div class="panel text-center">
                            <p class="text-center">
                                H.M. Cole can accommodate almost any price point for custom apparel.
											<br>Here is a simple breakdown of our offerings:

                            </p>
                            <h3 class="panel-heading text-center">Suit Pricing</h3>
                            <div class="panel">
                                <table class="table">
                                    <tr>
                                        <th class="tg-yw4l">Book</th>
                                        <th class="tg-yw4l">Content</th>
                                        <th class="tg-yw4l">Price</th>
                                    </tr>
                                    <tr>
                                        <td class="tg-yw4l">H.M. Cole Signature</td>
                                        <td class="tg-yw4l">70/30 Blend</td>
                                        <td class="tg-yw4l">$599</td>
                                    </tr>
                                    <tr>
                                        <td class="tg-yw4l">Cavani Cotton</td>
                                        <td class="tg-yw4l">100% Cotton</td>
                                        <td class="tg-yw4l">$599</td>
                                    </tr>
                                    <tr>
                                        <td class="tg-yw4l">H.M. Cole Separates</td>
                                        <td class="tg-yw4l">70/30 Blend</td>
                                        <td class="tg-yw4l">$699</td>
                                    </tr>
                                    <tr>
                                        <td class="tg-yw4l">H.M. Cole Premium</td>
                                        <td class="tg-yw4l">Minimal Blend</td>
                                        <td class="tg-yw4l">$799</td>
                                    </tr>
                                    <tr>
                                        <td class="tg-yw4l">Cavani 120’s</td>
                                        <td class="tg-yw4l">100% Super 120’s Wool</td>
                                        <td class="tg-yw4l">$999</td>
                                    </tr>
                                    <tr>
                                        <td class="tg-yw4l">Vitale Barberis Canonico</td>
                                        <td class="tg-yw4l">Super 110-140’s</td>
                                        <td class="tg-yw4l">$1299</td>
                                    </tr>
                                    <tr>
                                        <td class="tg-yw4l">Drago</td>
                                        <td class="tg-yw4l">Super 150’s, Wool/Linen</td>
                                        <td class="tg-yw4l">$1699</td>
                                    </tr>
                                    <tr>
                                        <td class="tg-yw4l">Dormeuil 365, Iconik, Dorsilk</td>
                                        <td class="tg-yw4l">Super 110-120’s (silk)</td>
                                        <td class="tg-yw4l">$2199</td>
                                    </tr>
                                    <tr>
                                        <td class="tg-yw4l">Dormeuil Aquaplan</td>
                                        <td class="tg-yw4l">Super 130’s</td>
                                        <td class="tg-yw4l">$2499</td>
                                    </tr>
                                    <tr>
                                        <td class="tg-yw4l">Ermenegildo Zegna</td>
                                        <td class="tg-yw4l">Trofeo, others</td>
                                        <td class="tg-yw4l">$2999+</td>
                                    </tr>
                                </table>
                            </div>
                            <h3 class="panel-heading text-center">Shirting Pricing</h3>
                            <div class="panel">
                                <table class="table">
                                    <tr>
                                        <th class="tg-yw4l">Book</th>
                                        <th class="tg-yw4l">Content</th>
                                        <th class="tg-yw4l">Price</th>
                                    </tr>
                                    <tr>
                                        <td class="tg-yw4l">H.M. Cole Shirting</td>
                                        <td class="tg-yw4l">100% 2-ply Easy Care</td>
                                        <td class="tg-yw4l">$119</td>
                                    </tr>
                                    <tr>
                                        <td class="tg-yw4l">H.M. Cole Premium Shirting</td>
                                        <td class="tg-yw4l">100% 2-ply 120/2</td>
                                        <td class="tg-yw4l">$159</td>
                                    </tr>
                                    <tr>
                                        <td class="tg-yw4l">Canclini Italian Shirting</td>
                                        <td class="tg-yw4l">Varies (see book)</td>
                                        <td class="tg-yw4l">$249+</td>
                                    </tr>
                                </table>
                            </div>
                            <h3 class="panel-heading text-center">Shoes &Accessories Pricing</h3>
                            <div class="panel">
                                <table class="table">
                                    <tr>
                                        <th class="tg-yw4l">Item</th>
                                        <th class="tg-yw4l">Content</th>
                                        <th class="tg-yw4l">Price</th>
                                    </tr>
                                    <tr>
                                        <td class="tg-yw4l">Allen Edmonds</td>
                                        <td class="tg-yw4l">Shoes &amp;Accessories</td>
                                        <td class="tg-yw4l">Standard Retail</td>
                                    </tr>
                                    <tr>
                                        <td class="tg-yw4l">Neckwear</td>
                                        <td class="tg-yw4l">Microfiber, Silk</td>
                                        <td class="tg-yw4l">$59/$99</td>
                                    </tr>
                                    <tr>
                                        <td class="tg-yw4l">Handkerchiefs</td>
                                        <td class="tg-yw4l">Cotton, Viscose, Silk</td>
                                        <td class="tg-yw4l">$29</td>
                                    </tr>
                                    <tr>
                                        <td class="tg-yw4l">Cufflinks</td>
                                        <td class="tg-yw4l">Rhodium Plated</td>
                                        <td class="tg-yw4l">~$49</td>
                                    </tr>
                                </table>
                            </div>
                            <!--
											</p><ul style="padding: 10px 10px 10px 31px;display: block;width: 348px;margin: 0 auto;background: #ECECEC;">
												<li>H.M. Cole Signature Series - <b>$599</b>
												</li><li>Specialty Fabrics - <b>$799</b> (full-suit), <b>$525</b> (blazer only)
												</li><li>H.M. Cole Premium Series - <b>$799</b>
												</li><li>Cavani Four Seasons - <b>$999</b>
												</li><li>VBC Classics/Lightweights - <b>$1299</b>
												</li><li>Drago - <b>$1599</b>
												</li><li>Ariston - <b>$1999</b>
												</li><li>Dormeuil - <b>$1999</b>
												</li><li>Zegna - <b>$2999+</b>
											</li></ul>
										<p></p>-->
                        </div>
                    </div>
                    <div class="tab-pane fade" id="trainingTab" style="min-height:400px;padding-top:25px;">
                        <h1>Training and Education Materials</h1>
                        <div class="panel text-center" style="text-align:center;">
                            <p>The resources on this page will help you to become familiar with fabrics and garment construction.
										Review as frequently as needed.  These resources will always be available to you here in the A Creative Cliche menswear portal.
										</p>
                            <div class="panel resource">
                                <a target="_blank" href="/img/vendors/hmcole/Fabrics.pdf">
                                    <h3>Fabric Information (About Wool)</h3>
                                    <p>
                                        <em style="font-weight: normal;">5.07MB PDF</em>
                                    </p>
                                    <p>Everything you need to know about wools and cotton.</p>
                                    <img src="/img/vendors/hmcole/fabrics1.jpg" style="width: 100%;">
                                </a>
                            </div>
                            <div class="panel resource">
                                <a target="_blank" href="/img/vendors/hmcole/Construction.pdf">
                                    <h3>Construction &Manufacturing</h3>
                                    <p>
                                        <em style="font-weight: normal;">4.46MB PDF</em>
                                    </p>
                                    <p>Measuring techniques and garment construction.</p>
                                    <img src="/img/vendors/hmcole/manufacturing1.jpg" style="width: 100%;">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="strategiesTab" style="min-height:400px;padding-top:25px;">
                        <h1>Strategies &Marketing Help</h1>
                        <div class="panel">
                            <p class="text-center">
                                <br/>
                                <br/>
                                <br/>
                                <em>Stay tuned for marketing and growth strategies from H.M. Cole!</em>
                                <br/>
                                <br/>
                                <br/>
                            </p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="programTab" style="min-height:400px;padding-top:25px;">
                        <div class="panel">
                            <h3 style="text-align:center;">Important Information</h3>
                            <p>In our quest to provide the best solutions for today's image professionals, A Creative Cliche has partnered with H.M. Cole
											to provide a new alternative for custom apparel.  The H &S + H.M. Cole program is unique in many ways.
										</p>
                            <p>Please carefully review the following information.  This page contains details about our commitment to you, and our expectations.
											A Creative Cliche members receive:
										</p>
                            <div class="row-fluid" style="margin-bottom:10px;margin-top:10px;padding-top:10px;border-top: 1px solid black;">
                                <div class="col-xs-4">
                                    <img alt="" src="https://ci5.googleusercontent.com/proxy/K1cUyNk-VJvA6QigokBhP87grubWTkzRRWm1wf4BDDR9w01LMHgjqPetvLG5jpFpa2Pi_un_nR-4bYvD4d7eezMsh7EQbw2ISvMpUfVJGpzweUTIEGp9btFcVLP8K8xca3ws5wBwLSIf1nfpRNQlSIYx4FolHRAP7VgOcos=s0-d-e1-ft#https://gallery.mailchimp.com/8e67a92e3d3425acf504ba085/images/ce72f78e-400e-451e-b0d7-82e00d6fe77a.jpg" style="width:100%;" tabindex="0">
                                </div>
                                <div class="col-xs-8">
                                    <h3 style="margin: 0 0 10px;">20% Commission</h3>
                                    <p>
                                        H &S members can depend on a great commission rate: <strong>20%</strong>
                                        - even if you have low volume!
													<strong>No quotas.  No pressure.</strong>
                                        Just do what you do best, and whenever you place an order, you earn.  If you
													anticipate <em>more</em>
                                        than $10,000 in sales in a month, bonuses are even available at higher volume.

                                    </p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="row-fluid" style="padding: 10px 0;border-top: 1px solid black;border-bottom: 1px solid black;margin-bottom: 10px;">
                                <div class="col-xs-4">
                                    <img alt="" src="https://ci5.googleusercontent.com/proxy/K1cUyNk-VJvA6QigokBhP87grubWTkzRRWm1wf4BDDR9w01LMHgjqPetvLG5jpFpa2Pi_un_nR-4bYvD4d7eezMsh7EQbw2ISvMpUfVJGpzweUTIEGp9btFcVLP8K8xca3ws5wBwLSIf1nfpRNQlSIYx4FolHRAP7VgOcos=s0-d-e1-ft#https://gallery.mailchimp.com/8e67a92e3d3425acf504ba085/images/ce72f78e-400e-451e-b0d7-82e00d6fe77a.jpg" style="width:100%;" tabindex="0">
                                </div>
                                <div class="col-xs-8">
                                    <h3 style="margin: 0 0 10px;">Access to Expert Tailors</h3>
                                    <p>The phenomenal supply chain at H.M. Cole is now in your toolbox! When you need a custom order, they deliver exceptional garments
													- every time. Simply add notes to the tailor via the H.M. Cole ordering app, as shown in your training.
												</p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="row-fluid" style="margin-bottom:10px;padding-bottom:10px;border-bottom: 1px solid black;margin-bottom: 10px;">
                                <div class="col-xs-4">
                                    <img alt="" src="https://ci5.googleusercontent.com/proxy/K1cUyNk-VJvA6QigokBhP87grubWTkzRRWm1wf4BDDR9w01LMHgjqPetvLG5jpFpa2Pi_un_nR-4bYvD4d7eezMsh7EQbw2ISvMpUfVJGpzweUTIEGp9btFcVLP8K8xca3ws5wBwLSIf1nfpRNQlSIYx4FolHRAP7VgOcos=s0-d-e1-ft#https://gallery.mailchimp.com/8e67a92e3d3425acf504ba085/images/ce72f78e-400e-451e-b0d7-82e00d6fe77a.jpg" style="width:100%;" tabindex="0">
                                </div>
                                <div class="col-xs-8">
                                    <h3 style="margin: 0 0 10px;">The Best Fabrics</h3>
                                    <p>You have been provided with world-class fabric samples to impress and assist your clients in
													finding the perfect material for their custom apparel at any price point.
												</p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <h3 style="text-align:center;">Expectations</h3>
                            <p>
                                <strong>It's also important to know what is expected of you.</strong>
                                While sales quotas
											and commitments have been waived wherever possible, H.M. Cole is still investing in your success - especially in providing swatch books and training.
											The following is expected of you:

                            </p>
                            <ol>
                                <li>
                                    <strong>Fabric Swatches:</strong>
                                    <ul>
                                        <li>
                                            You will be required to sign a 'release of property' agreement signifying your understanding that the &nbsp;
                                            <span style="line-height:20.8px">
                                                fabric swatch books have been provided to you <em>on loan</em>
                                                .&nbsp;
                                            </span>
                                        </li>
                                        <li>
                                            Y<span style="line-height:1.6em">ou may request additional books to satisfy your clients' needs. </span>
                                        </li>
                                        <li>
                                            <span style="line-height:20.8px">The fabric swatches are available to you while you are using them.&nbsp;</span>
                                            <span style="line-height:1.6em">These may be called back by H.M. Cole after a period of disuse. You may &nbsp;request fabric books again once you are ready to use them with a client.</span>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <strong>Placing Orders:</strong>
                                    <ul>
                                        <li>
                                            Orders must be placed through the H.M. Cole app, as was demonstrated in your hands-on training. &nbsp;If you need a refresher, reach out to <a href="mailto:orders@hmcole.com" target="_blank">orders@hmcole.com</a>
                                            .
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <strong>Taking Payment:</strong>
                                    <ul>
                                        <li>Payment must be taken through the Hue &amp;Stripe invoicing system - ie, via credit card - and requires an internet connection.&nbsp;(Notice, that this will store your customer's card on file for future visits and automatically track your commission earnings.) &nbsp;</li>
                                        <li>If you need help with this step, reach out to support@HueAndStripe.com and you will be contacted promptly.</li>
                                    </ul>
                                </li>
                                <li>
                                    <strong>Mis-Measurements and Mistakes:</strong>
                                    <ul>
                                        <li>
                                            If an item does not fit perfectly, then responsibility flows as follows:

                                            <ul>
                                                <li>
                                                    <em>Small Alterations:</em>
                                                    Inexpensive alterations, such as pant/sleeve length adjustments, are <strong>your responsibility to handle with local tailors</strong>
                                                    . &nbsp;These costs (averaging $25) are also your responsibility - so measure twice, order once to maximize commission earnings &nbsp;and &nbsp;client satisfaction!
                                                </li>
                                                <li>
                                                    <em>Re-Makes (Large Alterations): </em>
                                                    If an &nbsp;item needs to be remade, or undergo expensive alterations, an entirely new garment will be made and shipped at no extra cost to your client. &nbsp;This extra cost will automatically cancel any commissions on the item in question, so measure twice, order once! If &nbsp;your orders frequently require full re-makes, you may be required to undergo further training.
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <strong>Training Cost</strong>
                                    :

                                    <ul>
                                        <li>
                                            <span style="line-height:20.8px">Half of your first $300 in &nbsp;commission earnings ($149 total)&nbsp;will be deducted to cover the cost of your training.</span>
                                        </li>
                                    </ul>
                                </li>
                            </ol>
                            <p>We look forward to helping you provide your clients with the best custom apparel solutions available, and growing your business together.
											We are committed to making this the best custom menswear program available.  If you have any questions about your participation in the A Creative Cliche + H.M. Cole menswear
											program, please don't hesitate to get in touch at support@HueAndStripe.com or via the 'Contact Us' button below in the footer. For time-sensitive
											inquiries, you may reach us at (949) 230-2232.
										</p>
                            <p>
                                <em>*The terms of this program are subject to change.  You will receive information from A Creative Cliche with any updates.</em>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-2 col-lg-push-2 hidden-sm hidden-xs" style="padding: 10px 5px;background: #EFEFEF;border-left: 1px solid #E0E0E0;position: absolute;left: initial;right: -15px;top: 0;bottom: 0;">
            <div class="" style="background: #FFFFFF;border:none;margin:0 0 20px;text-align: center;padding: 10px;word-break: break-word;">
                <p style="font-size: 20px;font-weight: bold;">Questions?</p>
                <p style="max-width:500px;margin:0 auto;">Getting started with H.M. Cole custom menswear?  Have a question about an order?  Don't hesitate to get in touch!</p>
                <!--<p style="font-size: 14px;font-weight: bold;padding: 0;margin: 0;display: inline-block;"><button class="btn btn-ghost-dark btn-xs" style="white-space:normal;">Contact Us</button></p>-->
                <p style="margin: 10px 0 5px;">For payment questions, call A Creative Cliche at:</p>
                <p style="font-size: 18px;font-weight: bold;color: #717171;">(949) 230-2232</p>
                <p style="margin: 10px 0 5px;">For fabric or order questions, call H.M. Cole at:</p>
                <p style="font-size: 18px;font-weight: bold;color: #717171;">(385) 229-4447</p>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<body>
    <div class="container card">
        <div class="table-responsive">
            <table id="datatables" class="table table-striped">
                <tbody>
                    <thead>
                        <tr style="float: left;">
                            <th class="no-sort sorting_disabled"><span href="#"></span></th>
                            <th class="sorting" rowspan="1" colspan="1">
                                <span>Client Name</span>
                            </th>
                        </tr>
                    </thead>
                    <tr role="row" class="odd">
                        <td>
                            <img src="https://cdn.dribbble.com/users/332085/screenshots/1620589/wallpaper_dali_bleu.png" style="max-width: 10%; max-height: 10%; border-radius: 20%;" />
                            <p style="display: inline-block;">Person Name</p>
                            <p style="display: inline-block;"> </p>
                            <strong><p style="display: inline-block;"> City</p></strong>
                            <p style="display: inline-block;">,Country</p>
                            <p style="float:right;">+1 (123)-Number</p>

                        </td>
                        <td>
                            <p>Styles: Salvador era, Artistic</p>
                        </td>
                        <tr>
                            <td> <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAABJlBMVEVAotmnZjU+SnpDTHmUXTDxxqCjZzfxvY/muI39zaKlZjbsu473yqE8pN1BS3o+RnaVXCz3wZCpZC92qceXWiapZTCsYiNAnNJAp943peGqYypRmb/UqYuWWyqYWB7/0qfLpYl8dG4zQ3jpvZbksIRBk8dDRXJbk7FDn88rQXmtYRyhaj+KZkfKm3M5QXRhiqJvfoRCYI8/grZ1hpG3ekqLe4K+jWSDfnqBbl6dbEZDU4HoxKP2xJdnpsqxlIZmgJGEmaGitL3Jva/cwac/caO1t7aKq8LZtpNaWXttZn7Lt5+YrrxmpsiahYU/bJ5VYoVOU3q8m4iSf4R3bHxLfqtOb5hda4qUdGJohJOIenGqd01ajqnDk2uQYDiab1J+gYaQdmmJZUHMnyAcAAALTElEQVR4nO3dbV/ayBoHYEgAKTASKSgBoQoCadUioPhU223Xbe3Zs661PUcsRd3v/yVOEp4Cmck8hMwkHv4v+q5brt89M/fMJLCh0DLLLLPMMssss8wyyyyzzDLL8A4wI/pTeBLdpapasWGkqKmq+qycQAXFRuf+dP3Nup5CobBeeDhuFp+LEQCt8fgQyxUy4WESMT2JXC5219TUwCN1Xv/+tFDIhacxhUbCudNHLdhEAIrHp+sZK88qNCq52wsF1whA82G9ELbFItSNhYeiavkrqplAzFAQap4WcnbfnFAfq7EmGP+VxoftvcFg7+Sgofkdqfse4D6bMJYIdwwN0Hp7Srak6Clls4Pthq+nKCg+oXx2YSxW6IEQ6O9llcgkSqm8598pCkAvnEH5YMJYrq8elC2+IbK811fx/5qAAO1hHe2DChO7J+WIPUr5xI9DFTQSyAGKEupGCFBPadDwHRF0cs5AuDAGF0YUpeczInh0HKFoIZKY7fhqMoInLJBSGIlkD/xEfILsYQiFaGK545+Bek8ARAodqtj0CZFgDrIJlUjRF0S1Q1JBByGaWNoTjTMCGmRAFmEkeyx+tQEapg26EkayPuj8dw5bUUKhA1G5E+0DHaJVhlkYKQteT0GR1OcodCqi6MWGeIyyCgUXEfQI11EXQmVPEygM7ZIupBih43LaF1dEQNjr3QlLJ+J6InErdCWMRIqigOCRpoTOQsdh+kHUMNVOF1dD57VG0DAFPeJm704YKQtaTSlL6EYopiXSLaSuhNlHMRORsoQuhGJ2bqBPCXQhFDMR1SfyHal7oYhtjfaGEuhGmD3gL6ReZ1wJS9sCanhHOw3dCJUT7j6g0XV7t0L+JyiGQepGGBnw33zTD1IXZwt9qeF9NQyKMWqgK2GZu7BJPw3dCXk3RPWett1jhBiggGc0tHvSoAmZpiHjjfBIyHlTA5r0vSJYQvX42QsfGKYh27OnsZDzmxmAwedSyHelAUWWEqKF8699+UDYZ+iGSGGi+wtPLPN9UEr1PAYvrEb3S1gh310b5V23szCxH41Gd3DCEmch9RWNUw2jUTxR4Xx6AkzNAiHcN4XRfce5yP0EvMsChAu70VG6TkTutxhMQLiwOhZGfzpNw23Oz2aoLxJRwsTOBBitOhSR+23iooSJX1FLHNoi50czoMhwwIcKD6Mz2UULOS+lCxNWZ4XI9VQZbARTOAdELza8l9JFCePzQGQRs5xfFl6Q0A6MVhEzkfdN20KECQgQ2fb5Pz5cQLeAAqM7UKHyD/d3MdwKE7u2RWYUqJD3NNTDtPGeChM/UUD4aqrwf0/Y3c470UX54BNRGfD2uTs9JcbnJWhg/YL7tlsXGk8tGJ8fltAjFLXUCHiZ3bjFyHSoh2oCV0A9VcggFfAGLegVMvcqw7sYDkvMOJASCnghCvQLu0V6YfhwB+eLpuxC7g9HDWGxcK/SvqqQC2MGKEIo4DUMPWqhQfkyRiax/yJFILSfEcW8lwhONEDzTlTucOfdKzahEhHgM54faiGKeWj6XhAJbaNUxPteoxAKM5lu8pXhYxWK+7KFSvKgWx+eL4Y8QuF8t8g+ivsmgop9WSF3+Cs59ZEJbR1f4JdI1SdHYS7RHc4+OmF8dteWFfFO4jjOD6AO53mEwvmdt8jvATu9j5HbeWXzsQhFvcE+EhYTSOA+xEcmnDkfKhGh31pzOAfnYD4y4cwZvyz4pzHQr7IfQktIJJwp4UDwl5xHXwqCMOGDlEQYtz7QF/m9w6GwaA7TRztxh3mUWheaLP/LCxtRH6a5fsi+pLILu5Yx+o/gZcYQ9tczx0Cz796YhdZbfV/86of2sN4AkFdNmYWWHY3Q3cwkoPcGwN5pZxZOnwIrA/Fj1MwdbPeW2WFdS6fd0A8/h2GmCN29sXaL6cFC4LkXEvuFTZdROOkVWSG3T8jYX6dl3dOMV1K9UfiphLBhyiaMj4GKP347yRKjX5xafj8iw7aWjs8VnN8lJYhZxNPmtPNnkkzCEVDc7ws4RN++FbTpYEW0C4xwtM74axkdBWi7uUJT7U3uF7ssNRw2w/K2aA00oBgrHKvqwbiKhwzC4Y6t/Cjagggonj7of06+aPKOXmiuM1l/VtAI0I6NJX5EzEB3po7CasTfwFBo+NO/4Njc4MCvohyFRgl9Ogdnow5/QhE6EZ2ERgnLB6I/PVFAJ4eaiE7CrqKU/dgHYQHNcC6cg01EB2E1okT89qu66Ji/mAw7XjgIu6WBT3/gGhqgnRZgExEtrJb3fLfZdgwI3RcgW1OUMHX+c9u3v8KOCuhAJiJCmDr/LShrjDXgJakwdX7hr/MuadSLcyJh6jyYPj3q5zUC4YtPgZuBk4CXK+9wwlT0o+iP6SK6cGXWaBOmfn8Z2AKGRsIZok34R3BHqJGh0GqcE1arF4EGToS68R1EWI3Hv1yI/ozuMhWOC5ma8T0zoVnJ1Ghwxkd5bsKVlWR8Li9Ff0Z3WQqXQv8HfF77vxcmPwe842OFK0EXfsTW8M9gC1W88GOArtcgUT9hhX8EXPgvrPBTwIVVbD/8EmxhaB5oF8ZFf0RXARd4YfLfoj+lm4A/56chRBjoxRTYFhrIKP0i+lO6CLiwASHClY+B7fmgvUUijG/+CCgx376y+aDC+FU7L/rDsiTffvvVXkKYMPk1/SN4xPzGdbpyRCg8kurXG8Ey5kPts7RU+YtQ+Fdarp+1Q8ExglC7lZYkqfKeUPg+LctyvdUOxP1+Xi/fpWT4JOk1sbAiG6nLlzXjP+DXAJAP1drtlpQe+nThJpkwvjUUmmn9aOtM4LdqgtBGrX3ZOpvqhkLCbmEV6pWUz1qX7dqGf8asXjodl57BuRAOmfW6zqz5AmkumzbcMKTCTXl1njhk+mGBzbclBE+SZJdCc8i2BZdxo4X06d2CeJRKCKDZRPj+WuJcamcOQDfz0JqzmjAfaDvwFieUhY3UfNupgIYQcniCdvxvGKEoYg0DpNi14YR1IQN14wwDpNp5Y3Ij4quW17gSShSnJ5xw9b/8/2dWuEloCElPwN+xQjnd5N36a6tYoCQR32KgGr6liDec3w3L/wdfQkm6iRMJN2/wQjn9ne84JSqhJBHdtSW3CID6vu43nkXM/01SQmi7gAjfY5dSI9J3nu8W1d4SlbDynUhIsNAYecuziESzUI9MJCSZhmYR+c1EjWwW6kW0T0T7kxmnk4U1qzfcXmrI/yAsIWxXYxfidzSjpDvcemKLEKh3RAIhQTccFfErr7UGu+Wexn7dZnuOjzs6WVLn9Fsu4JJcWDnC1ZBgUzodph84DVPsocISeX5bMy8k2tCMh+nffFbTGgXQvtbMCcnXGUN4w+XLbSSnCkvm96ZJ9hIaJwwewjz5SmoWce6QOCtMHlGU0BimXJYaKqA0v/2eESa3kDelcKHMYyJS9IphEa8chFfkC+kwHC5ssDdstryeWWyswuQteS8cps7jiT/+fsZG/LYGFeLv2Oy59h5I1Q1HWbVMxakw+Y1uEpo54yCkLqEkpW+mxIkwuUXVKEapew+kXWjMVOTJ/jQ5Acq0q4wp9Hypoez3k0zmYnI8RCsMFTSWGq87Is22e7aMt8m1iTAZv5WYgHL90vOeT7+UjolX5mRMmgW8otrKWOP9Ykq3Z5shVo7ia2u6cPNIYpmCw7S8BuKfxzgZpdv42uatzFxAPWdePxLeYB2kI+Prm0qabQaO47WQqVnMxBWPQ7tgbBbTuCug0S68BdLvuxcv9HbvzdwOFyaUPW6IeeZ2uDDhtbc1pLzC8ELY8viE6AOht8DnL3S1pVmM0ONNzVIYfCHVjb5HQm+3bT4QenxluhQuhQEQuj4euhbSHhD/ByliAqInFjnXAAAAAElFTkSuQmCC"
                                    style="max-width: 30%; max-height: 30%; border-radius: 20%;" />
                                <p style="display: inline-block;">Person Name</p>
                                <p style="display: inline-block;"> </p>
                                <strong><p style="display: inline-block;"> City</p></strong>
                                <p style="display: inline-block;">,Country</p>
                                <p style="float:right;">+1 (123)-Number</p>Some Facts</td>
                            <td>
                                <p>Styles: Salvador era, Artistic</p>
                            </td>
                        </tr>

                    </tr>
                    <tr>
                        <td><img src="https://cdn.dribbble.com/users/332085/screenshots/1620589/wallpaper_dali_bleu.png" style="max-width: 10%; max-height: 10%; border-radius: 20%;" />
                            <p style="display: inline-block;">Person Name</p>
                            <p style="display: inline-block;"> </p>
                            <strong><p style="display: inline-block;"> City</p></strong>
                            <p style="display: inline-block;">,Country</p>
                            <p style="float:right;">+1 (123)-Number</p>

                        </td>
                        <td>
                            <p>Styles: Salvador era, Artistic</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAABJlBMVEVAotmnZjU+SnpDTHmUXTDxxqCjZzfxvY/muI39zaKlZjbsu473yqE8pN1BS3o+RnaVXCz3wZCpZC92qceXWiapZTCsYiNAnNJAp943peGqYypRmb/UqYuWWyqYWB7/0qfLpYl8dG4zQ3jpvZbksIRBk8dDRXJbk7FDn88rQXmtYRyhaj+KZkfKm3M5QXRhiqJvfoRCYI8/grZ1hpG3ekqLe4K+jWSDfnqBbl6dbEZDU4HoxKP2xJdnpsqxlIZmgJGEmaGitL3Jva/cwac/caO1t7aKq8LZtpNaWXttZn7Lt5+YrrxmpsiahYU/bJ5VYoVOU3q8m4iSf4R3bHxLfqtOb5hda4qUdGJohJOIenGqd01ajqnDk2uQYDiab1J+gYaQdmmJZUHMnyAcAAALTElEQVR4nO3dbV/ayBoHYEgAKTASKSgBoQoCadUioPhU223Xbe3Zs661PUcsRd3v/yVOEp4Cmck8hMwkHv4v+q5brt89M/fMJLCh0DLLLLPMMssss8wyyyyzzDLL8A4wI/pTeBLdpapasWGkqKmq+qycQAXFRuf+dP3Nup5CobBeeDhuFp+LEQCt8fgQyxUy4WESMT2JXC5219TUwCN1Xv/+tFDIhacxhUbCudNHLdhEAIrHp+sZK88qNCq52wsF1whA82G9ELbFItSNhYeiavkrqplAzFAQap4WcnbfnFAfq7EmGP+VxoftvcFg7+Sgofkdqfse4D6bMJYIdwwN0Hp7Srak6Clls4Pthq+nKCg+oXx2YSxW6IEQ6O9llcgkSqm8598pCkAvnEH5YMJYrq8elC2+IbK811fx/5qAAO1hHe2DChO7J+WIPUr5xI9DFTQSyAGKEupGCFBPadDwHRF0cs5AuDAGF0YUpeczInh0HKFoIZKY7fhqMoInLJBSGIlkD/xEfILsYQiFaGK545+Bek8ARAodqtj0CZFgDrIJlUjRF0S1Q1JBByGaWNoTjTMCGmRAFmEkeyx+tQEapg26EkayPuj8dw5bUUKhA1G5E+0DHaJVhlkYKQteT0GR1OcodCqi6MWGeIyyCgUXEfQI11EXQmVPEygM7ZIupBih43LaF1dEQNjr3QlLJ+J6InErdCWMRIqigOCRpoTOQsdh+kHUMNVOF1dD57VG0DAFPeJm704YKQtaTSlL6EYopiXSLaSuhNlHMRORsoQuhGJ2bqBPCXQhFDMR1SfyHal7oYhtjfaGEuhGmD3gL6ReZ1wJS9sCanhHOw3dCJUT7j6g0XV7t0L+JyiGQepGGBnw33zTD1IXZwt9qeF9NQyKMWqgK2GZu7BJPw3dCXk3RPWett1jhBiggGc0tHvSoAmZpiHjjfBIyHlTA5r0vSJYQvX42QsfGKYh27OnsZDzmxmAwedSyHelAUWWEqKF8699+UDYZ+iGSGGi+wtPLPN9UEr1PAYvrEb3S1gh310b5V23szCxH41Gd3DCEmch9RWNUw2jUTxR4Xx6AkzNAiHcN4XRfce5yP0EvMsChAu70VG6TkTutxhMQLiwOhZGfzpNw23Oz2aoLxJRwsTOBBitOhSR+23iooSJX1FLHNoi50czoMhwwIcKD6Mz2UULOS+lCxNWZ4XI9VQZbARTOAdELza8l9JFCePzQGQRs5xfFl6Q0A6MVhEzkfdN20KECQgQ2fb5Pz5cQLeAAqM7UKHyD/d3MdwKE7u2RWYUqJD3NNTDtPGeChM/UUD4aqrwf0/Y3c470UX54BNRGfD2uTs9JcbnJWhg/YL7tlsXGk8tGJ8fltAjFLXUCHiZ3bjFyHSoh2oCV0A9VcggFfAGLegVMvcqw7sYDkvMOJASCnghCvQLu0V6YfhwB+eLpuxC7g9HDWGxcK/SvqqQC2MGKEIo4DUMPWqhQfkyRiax/yJFILSfEcW8lwhONEDzTlTucOfdKzahEhHgM54faiGKeWj6XhAJbaNUxPteoxAKM5lu8pXhYxWK+7KFSvKgWx+eL4Y8QuF8t8g+ivsmgop9WSF3+Cs59ZEJbR1f4JdI1SdHYS7RHc4+OmF8dteWFfFO4jjOD6AO53mEwvmdt8jvATu9j5HbeWXzsQhFvcE+EhYTSOA+xEcmnDkfKhGh31pzOAfnYD4y4cwZvyz4pzHQr7IfQktIJJwp4UDwl5xHXwqCMOGDlEQYtz7QF/m9w6GwaA7TRztxh3mUWheaLP/LCxtRH6a5fsi+pLILu5Yx+o/gZcYQ9tczx0Cz796YhdZbfV/86of2sN4AkFdNmYWWHY3Q3cwkoPcGwN5pZxZOnwIrA/Fj1MwdbPeW2WFdS6fd0A8/h2GmCN29sXaL6cFC4LkXEvuFTZdROOkVWSG3T8jYX6dl3dOMV1K9UfiphLBhyiaMj4GKP347yRKjX5xafj8iw7aWjs8VnN8lJYhZxNPmtPNnkkzCEVDc7ws4RN++FbTpYEW0C4xwtM74axkdBWi7uUJT7U3uF7ssNRw2w/K2aA00oBgrHKvqwbiKhwzC4Y6t/Cjagggonj7of06+aPKOXmiuM1l/VtAI0I6NJX5EzEB3po7CasTfwFBo+NO/4Njc4MCvohyFRgl9Ogdnow5/QhE6EZ2ERgnLB6I/PVFAJ4eaiE7CrqKU/dgHYQHNcC6cg01EB2E1okT89qu66Ji/mAw7XjgIu6WBT3/gGhqgnRZgExEtrJb3fLfZdgwI3RcgW1OUMHX+c9u3v8KOCuhAJiJCmDr/LShrjDXgJakwdX7hr/MuadSLcyJh6jyYPj3q5zUC4YtPgZuBk4CXK+9wwlT0o+iP6SK6cGXWaBOmfn8Z2AKGRsIZok34R3BHqJGh0GqcE1arF4EGToS68R1EWI3Hv1yI/ozuMhWOC5ma8T0zoVnJ1Ghwxkd5bsKVlWR8Li9Ff0Z3WQqXQv8HfF77vxcmPwe842OFK0EXfsTW8M9gC1W88GOArtcgUT9hhX8EXPgvrPBTwIVVbD/8EmxhaB5oF8ZFf0RXARd4YfLfoj+lm4A/56chRBjoxRTYFhrIKP0i+lO6CLiwASHClY+B7fmgvUUijG/+CCgx376y+aDC+FU7L/rDsiTffvvVXkKYMPk1/SN4xPzGdbpyRCg8kurXG8Ey5kPts7RU+YtQ+Fdarp+1Q8ExglC7lZYkqfKeUPg+LctyvdUOxP1+Xi/fpWT4JOk1sbAiG6nLlzXjP+DXAJAP1drtlpQe+nThJpkwvjUUmmn9aOtM4LdqgtBGrX3ZOpvqhkLCbmEV6pWUz1qX7dqGf8asXjodl57BuRAOmfW6zqz5AmkumzbcMKTCTXl1njhk+mGBzbclBE+SZJdCc8i2BZdxo4X06d2CeJRKCKDZRPj+WuJcamcOQDfz0JqzmjAfaDvwFieUhY3UfNupgIYQcniCdvxvGKEoYg0DpNi14YR1IQN14wwDpNp5Y3Ij4quW17gSShSnJ5xw9b/8/2dWuEloCElPwN+xQjnd5N36a6tYoCQR32KgGr6liDec3w3L/wdfQkm6iRMJN2/wQjn9ne84JSqhJBHdtSW3CID6vu43nkXM/01SQmi7gAjfY5dSI9J3nu8W1d4SlbDynUhIsNAYecuziESzUI9MJCSZhmYR+c1EjWwW6kW0T0T7kxmnk4U1qzfcXmrI/yAsIWxXYxfidzSjpDvcemKLEKh3RAIhQTccFfErr7UGu+Wexn7dZnuOjzs6WVLn9Fsu4JJcWDnC1ZBgUzodph84DVPsocISeX5bMy8k2tCMh+nffFbTGgXQvtbMCcnXGUN4w+XLbSSnCkvm96ZJ9hIaJwwewjz5SmoWce6QOCtMHlGU0BimXJYaKqA0v/2eESa3kDelcKHMYyJS9IphEa8chFfkC+kwHC5ssDdstryeWWyswuQteS8cps7jiT/+fsZG/LYGFeLv2Oy59h5I1Q1HWbVMxakw+Y1uEpo54yCkLqEkpW+mxIkwuUXVKEapew+kXWjMVOTJ/jQ5Acq0q4wp9Hypoez3k0zmYnI8RCsMFTSWGq87Is22e7aMt8m1iTAZv5WYgHL90vOeT7+UjolX5mRMmgW8otrKWOP9Ykq3Z5shVo7ia2u6cPNIYpmCw7S8BuKfxzgZpdv42uatzFxAPWdePxLeYB2kI+Prm0qabQaO47WQqVnMxBWPQ7tgbBbTuCug0S68BdLvuxcv9HbvzdwOFyaUPW6IeeZ2uDDhtbc1pLzC8ELY8viE6AOht8DnL3S1pVmM0ONNzVIYfCHVjb5HQm+3bT4QenxluhQuhQEQuj4euhbSHhD/ByliAqInFjnXAAAAAElFTkSuQmCC"
                                style="max-width: 30%; max-height: 30%; border-radius: 20%;" />
                            <p style="display: inline-block;">Person Name</p>
                            <p style="display: inline-block;"> </p>
                            <strong><p style="display: inline-block;"> City</p></strong>
                            <p style="display: inline-block;">,Country</p>
                            <p style="float:right;">+1 (123)-Number</p>
                        </td>
                        <td>
                            <p>Styles: Salvador era, Artistic</p>
                        </td>
                    </tr>
                    <tr>
                        <td><img src="https://cdn.dribbble.com/users/332085/screenshots/1620589/wallpaper_dali_bleu.png" style="max-width: 10%; max-height: 10%; border-radius: 20%;" />
                            <p style="display: inline-block;">Person Name</p>
                            <p style="display: inline-block;"> </p>
                            <strong><p style="display: inline-block;"> City</p></strong>
                            <p style="display: inline-block;">,Country</p>
                            <p style="float:right;">+1 (123)-Number</p>

                        </td>
                        <td>
                            <p>Styles: Salvador era, Artistic</p>
                        </td>
                    </tr>
                </tbody>

            </table>
        </div>
    </div>

</div></div></div></div></div>
<div id="footer">
    <footer>
        <div class="container" style="text-align:center;">
            <h2 style="margin:0;text-align: center;width: 100%;">
                <a class="navbar-brand" href="#" style="float: none;color:rgba(255, 255, 255, 0.89); font-size: 23px;">A Creative Cliche</a>
            </h2>
            <nav class="navbar" role="navigation" style="margin: 0;text-align: center;">
                <div class="container-fluid">
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1 text-center" style="">
                        <ul class="nav navbar-nav white" style="display: inline-block;float: none;">
                            <li>
                                <a style="text-shadow:none;" href="/about">About Us</a>
                            </li>
                            <li>
                                <a target="_blank" style="text-shadow:none;" href="/termsOfService">Terms of Service</a>
                            </li>
                            <li>
                                <a target="_blank" style="text-shadow:none;" href="/privacy">Privacy Policy</a>
                            </li>
                            <li>
                                <a style="text-shadow:none;" href="/faq">FAQ</a>
                            </li>
                            <li>
                                <a id="contactLink" style="text-shadow:none;" href="#">Contact Us</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div style="">
                <p style="color:rgba(255, 255, 255, 0.89);">
                    <em>&copy;2018 One Spot Shoppe, Inc. All rights reserved.</em>
                </p>
            </div>
            <div class="clear"></div>
        </div>
    </footer>
</div>
<div id="old-browser-grumble" class="alert alert-danger" style="display:none;text-align:center;border-bottom:2px dashed red;color:#333;margin-bottom:0;">
    <b>Oh no!  You're using an out of date browser!</b>
    Here at A Creative Cliche, we use state-of-the-art web technologies to make your experience perfect.<br/>
    Let us help you out.  Try one of these free, modern alternatives:  <a href="http://google.com/chrome">Google Chrome</a>
    , <a href="http://firefox.com/">Mozilla Firefox</a>
    , or  <a href="http://support.apple.com/downloads/#safari">Apple's Safari</a>
    .

</div>
<!-- itemDetailsModal Modal -->
<div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="overflow-y: auto;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Contact Us</h4>
            </div>
            <div class="modal-body" style="font-size:14px;text-align:center;">
                <p>
                    <strong>Have an idea for a great feature? Found a bug? We'd love to hear from you.</strong>
                </p>
                <p>
                    Get in touch! Shoot us an email at <a href="mailto:support@hueandstripe.com">support@HueAndStripe.com</a>
                    or simply
						send us a message through the form below.  We'll get back to you shortly!

                </p>
                <div class="row">
                    <div class="col-md-12">
                        <form id="contactForm" class="form-horizontal" action="" method="post">
                            <!-- Email input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="email">Your E-mail</label>
                                <div class="col-md-9">
                                    <input id="contactEmail" name="contactEmail" value="youremail@consultant.com" type="text" placeholder="Your email..." class="form-control">
                                </div>
                            </div>
                            <!-- Message body -->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="message">Your message</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" id="contactMessage" name="contactMessage" placeholder="Please enter your message here..." rows="5"></textarea>
                                </div>
                            </div>
                            <!-- Form actions -->
                            <div class="form-group">
                                <div class="col-md-12 text-right">
                                    <button id="submitContactBtn" type="submit" class="btn btn-ghost-dark">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--
				<div class="modal-footer">
					<button type="button" class="btn btn-ghost-dark" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-ghost-dark full">Save changes</button>
				</div>
				-->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<div id="modalBackground" class="hidden"></div>
<!-- Modal -->
<div class="modal fade" id="addClientModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Create a New Client</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1 col-lg-8 col-lg-offset-2">
                        <form action="/clients/add" style="margin-top: 15px;" class="form-horizontal" id="addClientForm" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                            <div style="display:none;">
                                <input type="hidden" name="_method" value="POST"/>
                                <input type="hidden" name="data[_Token][key]" value="2ef711eac0c894d69d0105140b7f1640db19c373" id="Token928093037"/>
                            </div>
                            <div class="form-group">
                                <label for="ClientFirstName" class="col-sm-3 control-label">First Name</label>
                                <div class="col-sm-9">
                                    <input name="data[Client][first_name]" style="font-size:16px;height:41px;" class="form-control required" autocomplete="off" required="required" placeholder="Client&#039;s First Name..." maxlength="64" type="text" id="ClientFirstName"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ClientLastName" class="col-sm-3 control-label">Last Name</label>
                                <div class="col-sm-9">
                                    <input name="data[Client][last_name]" style="font-size:16px;height:41px;" class="form-control required" autocomplete="off" required="required" placeholder="Client&#039;s Last Name..." maxlength="64" type="text" id="ClientLastName"/>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label for="ClientEmail" class="col-sm-3 control-label">Email</label>
                                <div class="col-sm-9">
                                    <input name="data[Client][email]" style="font-size:16px;height:41px;" class="form-control required" autocomplete="off" required="required" placeholder="Client&#039;s Email Address..." type="email" id="ClientEmail"/>
                                </div>
                            </div>
                            <br/>
                            <div class="form-group">
                                <label for="ClientCity" class="col-sm-3 control-label">City</label>
                                <div class="col-sm-9">
                                    <input name="data[Client][city]" style="font-size:16px;height:41px;" class="form-control required" autocomplete="off" required="required" placeholder="Client&#039;s City..." maxlength="64" type="text" id="ClientCity"/>
                                </div>
                            </div>
                            
                            <div class="customStateWrap hidden">
                                <div class="form-group">
                                    <label for="ClientState" class="col-sm-3 control-label">State</label>
                                    <div class="col-sm-9">
                                        <input name="data[Client][state]" style="font-size:16px;height:41px;" class="form-control required" autocomplete="off" required="required" placeholder="State or Province..." maxlength="64" type="text" id="ClientState"/>
                                    </div>
                                </div>
                            </div>
                            <div class="ddlCountryWrap">
                                <div class="form-group">
                                    <label for="ClientCountry" class="col-sm-3 control-label">Country</label>
                                    <div class="col-sm-9">
                                        <select name="data[Client][country]" style="font-size:16px;height:41px;" class="form-control required" autocomplete="off" required="required" id="ClientCountry">
                                            <option value="USA">United States</option>
                                            <option value="CAN">Canada</option>
                                            <option value="0">Other</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="customCountryWrap hidden">
                                <div class="form-group">
                                    <label for="ClientCountry" class="col-sm-3 control-label">Country</label>
                                    <div class="col-sm-9">
                                        <input name="data[Client][country]" style="font-size:16px;height:41px;" class="form-control required" autocomplete="off" required="required" placeholder="Country..." maxlength="64" type="text" id="ClientCountry"/>
                                    </div>
                                </div>
                            </div>
                            <hr/>
                            <div class="form-group last">
                                <div class="submit">
                                    <input class="btn btn-ghost-dark full black" style="margin:0 auto;display:block;font-family: 'Cinzel', serif;padding:10px 36px 12px;border-radius:0px;font-size: 20px;min-width:240px;" type="submit" value="Submit"/>
                                </div>
                                <div style="display:none;">
                                    <input type="hidden" name="data[_Token][fields]" value="c2b65fa5305680352af2f9852fdd47ae24935d88%3A" id="TokenFields1797630533"/>
                                    <input type="hidden" name="data[_Token][unlocked]" value="" id="TokenUnlocked908004269"/>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--
				<div class="modal-footer">
					<button type="button" class="btn btn-ghost-dark" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-ghost-dark full">Save changes</button>
				</div>
				-->
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- Modal -->
<div class="modal fade" id="addCatalogModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Create a New Catalog</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 col-sm-offset-1 col-lg-10 col-lg-offset-1">
                        <form action="/closets/add" style="margin-top: 15px;" class="form-horizontal" id="addClientForm" method="post" accept-charset="utf-8">
                            <div style="display:none;">
                                <input type="hidden" name="_method" value="POST"/>
                                <input type="hidden" name="data[_Token][key]" value="2ef711eac0c894d69d0105140b7f1640db19c373" id="Token400333164"/>
                            </div>
                            <div class="form-group">
                                <label for="ClosetTitle" class="col-sm-2 control-label">Title</label>
                                <div class="col-sm-10">
                                    <input name="data[Closet][title]" style="font-size:16px;height:41px;max-width: 80%;" class="form-control required" autocomplete="off" required="required" placeholder="Catalog Title" maxlength="128" type="text" id="ClosetTitle"/>
                                </div>
                            </div>
                            <p class="text-center" style="font-size:14px;font-style:italic;">
                                Catalogs are roundups of apparel or other items.  Use them when you want to share with <b>more than one</b>
                                client.  Private catalogs open new income opportunities!
                            </p>
                            <hr/>
                            <div class="form-group last">
                                <div class="submit">
                                    <input class="btn btn-ghost-dark full black" style="margin:0 auto;display:block;font-family: 'Cinzel', serif;padding:10px 36px 12px;border-radius:0px;font-size: 20px;min-width:240px;" type="submit" value="Submit"/>
                                </div>
                                <div style="display:none;">
                                    <input type="hidden" name="data[_Token][fields]" value="1f12c5ab5f34c0fbc24916dc913ec287ed5fe1cc%3A" id="TokenFields316828866"/>
                                    <input type="hidden" name="data[_Token][unlocked]" value="" id="TokenUnlocked1398442911"/>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--
				<div class="modal-footer">
					<button type="button" class="btn btn-ghost-dark" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-ghost-dark full">Save changes</button>
				</div>
				-->
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<div class="modal fade" id="clientFormModal" tabindex="-1" role="dialog" data-keyboard="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="min-height:100%;">
            <div class="modal-header">
                <button id="closeNewClientFormEditorBtn" class="btn btn-ghost" style="position:absolute;left:10px;top:15px;">
                    <span>Back </span>
                    &times;
                </button>
                <button id="closeClientFormModalBtn" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">New Client Form</h4>
            </div>
            <div class="modal-body">
                <div id="newClientFormInfoWrap" class="row">
                    <div class="col-sm-10 col-sm-offset-1 col-lg-10 col-lg-offset-1" style="font-size:14px;">
                        <p class="text-center">
                            <b>Send clients your 'New Client Form' to save time!</b>
                            <br/>Upon submission, clients will see a message saying you'll be in touch.

                        </p>
                        <p class="text-center">You will receive an email notification of their submission.
							</p>
                        <hr>
                        <div class="form-group last">
                            <div class="submit text-center">
                                <a id="previewNewClientFormsBtn" href="https://hueandstripe.com/f/xI7Pf?preview=1" target="_blank" class="btn btn-ghost-dark black">
                                    <i class="fa fa-file-text-o pull-right" style="position:relative;top:-2px;"></i>
                                    Preview Form

                                </a>
                                <a id="editNewClientFormsBtn" class="btn btn-ghost-dark black" href="https://hueandstripe.com/f/xI7Pf?edit=1">
                                    <i class="fa fa-gear pull-right" style="position:relative;top:-2px;"></i>
                                    Customize

                                </a>
                            </div>
                        </div>
                        <hr>
                        <form class="form-inline">
                            <div class="form-group" style="display:block;">
                                <label class="" for="exampleInputAmount">Shareable Link to Your New Client Form:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-file-text-o"></i>
                                    </div>
                                    <input type="text" class="form-control" data-link="https://hueandstripe.com/f/xI7Pf" id="newClientFormURL" value="https://hueandstripe.com/f/xI7Pf">
                                </div>
                            </div>
                        </form>
                        <hr>
                        <div class="panel panel-success" style="box-shadow: none;font-size:13px;">
                            <div class="panel-heading">
                                <h4 style="margin:0;line-height:12px;padding:3px 0 0;text-align:center;">Tips and Tricks:</h4>
                            </div>
                            <div class="panel-body">
                                <ul style="padding: 0 30px;margin:0;">
                                    <li style="padding-bottom: 10px;">Email signatures and social media bio's are a great place to share your link to always be sourcing new clients.
										</li>
                                    <li>Giving a presentation to a group?  Include the link to your New Client Form in an email blast to make it easier for new clients to
											get started working with you.
										</li>
                                </ul>
                            </div>
                        </div>
                        <hr>
                        <button data-dismiss="modal" class="btn btn-ghost-dark full black" style="padding:10px 16px 7px;display:block;margin:0 auto;">
                            Close <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <div id="newClientFormWrap" class="row"></div>
            </div>
            <!--
				<div class="modal-footer">
					<button type="button" class="btn btn-ghost-dark" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-ghost-dark full">Save changes</button>
				</div>
				-->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<div id="photoUploadModal" class='modal' style="overflow-y:auto;background:white;border-radius:1px;margin:0 auto;">
    <a id="closephotoUploadModal" data-look-id='' class="btn btn-ghost-light pull-right closeModalBtn" href="#" style="z-index:2;text-align:center;border:none;position: absolute;right: 0;">
        <i class="fa fa-times"></i>
    </a>
    <div id="photoUploadModalContent" class="text-center">
        <div class="modal-body">
            <div id="photoUploadModalCopy">
                <div class="row-fluid clearfix">
                    <div class="col-md-4 col-sm-6">
                        <div class="well" style="padding:20px 5px;background:black;box-shadow:none;border:none;color:white;">
                            <h3>Main Photo</h3>
                            <div id="clientPhotoMainCropper"></div>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-6">
                        <form action="/clientsPhotos/addPhoto" style="margin-top: 15px;" class="form-horizontal" id="addClientPhotosForm" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                            <div style="display:none;">
                                <input type="hidden" name="_method" value="POST"/>
                                <input type="hidden" name="data[_Token][key]" value="2ef711eac0c894d69d0105140b7f1640db19c373" id="Token1727167701"/>
                            </div>
                            <h3>Client Reference Photos</h3>
                            <p style="font-size:13px;">
                                You may upload up to <b>5</b>
                                photos of this client.  Recommended shots are: face, standing front, and standing side.
								<br/>
                                <em>Note: This section is NOT for apparel photos!</em>
                            </p>
                            <div class="text-center">
                                <div id="uploadPictureBtnWrap" style="display:inline-block;margin: 5px auto;padding: 8px 10px 5px;width:260px;position:relative;height:52px;cursor:pointer;overflow:hidden;">
                                    <button class="btn btn-ghost-dark full" style="display:inline-block;padding: 12px 10px 15px;font-size: 18px;height: 41px;width: 227px;position:absolute;top:0;bottom:0;left:0;right:0;">
                                        <span class="pull-left" style="width:85%">Upload Photos</span>
                                        <i class="fa fa-image pull-right" style="line-height: 14px;"></i>
                                    </button>
                                    <input type="file" multiple="multiple" accept="image/*" id="fileUploadSelector" name="data[ClosetSectionsItem][fileUploadSelector]" style="cursor:pointer;position:absolute;top:0;bottom:0;right:0;opacity:.01;width:200%;left:-100%;">
                                </div>
                                <div id="takePictureBtnWrap" style="display:inline-block;margin: 5px auto;padding: 8px 10px 5px;width:260px;position:relative;height:52px;cursor:pointer;overflow:hidden;">
                                    <button class="btn btn-ghost-dark full" style="display:inline-block;padding: 12px 10px 15px;font-size: 18px;height: 41px;width: 227px;position:absolute;top:0;bottom:0;left:0;right:0;">
                                        <span class="pull-left" style="width:85%">Take A Photo</span>
                                        <i class="fa fa-image pull-right" style="line-height: 14px;"></i>
                                    </button>
                                    <input type="file" capture="camera" accept="image/*" id="takePhotoSelector" name="data[ClosetSectionsItem][takePhotoSelector]" style="cursor:pointer;position:absolute;top:0;bottom:0;right:0;opacity:.01;width:200%;left:-100%;">
                                </div>
                            </div>
                            <hr style="margin:0 0 10px;">
                            <div id="clientPhotosGallery"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer" style="margin-top:0px;padding:5px 20px;">
            <button id="saveClientPhotoBtn" type="button" class="btn btn-ghost-dark full">Save changes</button>
        </div>
    </div>
</div>
<div id="newInvoiceModal" class='modal' style="overflow-y:auto;background:white;border-radius:1px;margin:0 auto;-webkit-overflow-scrolling: touch;-webkit-backface-visibility:hidden; -webkit-transform: translateZ(0);">
    <div id="newInvoiceModalContent" class="text-center" style="padding-bottom:20px;-webkit-backface-visibility:hidden; -webkit-transform: translateZ(0);">
        <div class="modal-body" style="background-color:#eee;padding:3px 15px;"></div>
        <button id="previewInvoiceBtn" type="button" class="btn btn-ghost-dark full" style="margin: 15px auto 20px;">Preview And Confirm &raquo;</button>
        <button id="editInvoiceBtn" type="button" class="btn btn-ghost-dark hidden" style="margin: 15px 10px 5px;">&laquo;Edit Invoice</button>
        <button id="payInvoiceBtn" type="button" class="hidden btn btn-ghost-dark full" style="margin: 15px 10px 5px 10px;">Charge Now</button>
        <button id="sendInvoiceBtn" type="button" class="hidden btn btn-ghost-dark full" style="margin: 15px 10px 5px 10px;padding: 9px 21px 6px;">
            Send Now <i class="fa fa-angle-double-right"></i>
        </button>
        <div class="modal-footer hidden" style="hidden margin-top:0px;padding:5px 20px;text-align:center;background-color: #eee;border: none;"></div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="selectClientModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Create a New Invoice</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="text-center col-sm-10 col-sm-offset-1 col-lg-8 col-lg-offset-2">
                        <h4 style="margin:0 0 10px 0;">Begin: Select a Client</h4>
                        <div id="clientSelectionWrap" style="overflow:scroll;background:#eee;">
                            <ul id="clientSelectionList"></ul>
                        </div>
                    </div>
                </div>
            </div>
            <!--
				<div class="modal-footer">
					<button type="button" class="btn btn-ghost-dark" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-ghost-dark full">Save changes</button>
				</div>
				-->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<div id="fullScreenIframe">
    <div class="iframeTopBar">
        <button id="returnFromPaymentBtn" class="btn btn-ghost-dark" style="padding:8px 40px 6px 35px;">
            <i class="fa fa-angle-double-left"></i>
            Return
        </button>
    </div>
    <div class="iframeBody"></div>
</div>
<div id="screenToSmall" class="text-center">
    <img src="/img/rotate.png" style="width:150px;"/>
    <p style=" font-family: 'Medio'; font-size: 26px; padding: 5px 30px; ">Screen size not supported.  Please rotate your device to 'landscape' mode or use a larger device.
		</p>
</div>
<script type="text/javascript">

		var WEBROOT = '/';
		var WEBROOT_HTTPS = 'https://hueandstripe.com/';

</script>
<script type="text/javascript" src="/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/jquery.masonry.min.js"></script>
<script type="text/javascript" src="/js/imagesloaded.pkgd.min.js"></script>
<script type="text/javascript" src="/js/jquery.hoverIntent.minified.js"></script>
<script type="text/javascript" src="/js/jquery-ui-1.11.4.custom.min.js"></script>
<script type="text/javascript" src="/js/hs.utils.js"></script>
<script type="text/javascript" src="/js/fastclick.min.js"></script>
<script type="text/javascript" src="/js/handlebars.runtime.min.js"></script>
<script type="text/javascript" src="/js/handlebars.helpers.js"></script>
<script type="text/javascript">

		$(document).ready(function() {
			if(!$.support.opacity) { /* IE 6-8 */
				$('#old-browser-grumble').css('display','block').prependTo('#wrap');
			}
		});

</script>
<script type="text/javascript" src="/js/jquery.cropper.min.js"></script>
<script type="text/javascript" src="/js/pikaday.js"></script>
<script type="text/javascript" src="/js/jquery.pikaday.js"></script>
<script type="text/javascript" src="/js/jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript" src="/js/jquery.zoom.min.js"></script>
<script type="text/javascript" src="/js/jquery.tablesorter.min.js"></script>
<script type="text/javascript" src="/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="/js/jquery.dataTables.bootstrap.js"></script>
<script type="text/javascript" src="/js/highcharts.min.js"></script>
<script type="text/javascript" src="/js/highcharts.standalone.min.js"></script>
<script type="text/javascript" src="/js/TweenMax.min.js"></script>
<script type="text/javascript" src="/js/jquery.gsap.min.js"></script>
<!--<script src="http://code.highcharts.com/adapters/standalone-framework.js"></script>
		<script src="http://code.highcharts.com/highcharts.js"></script>
		<script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/1.16.1/TweenMax.min.js"></script>
		<script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/1.16.1/plugins/CSSPlugin.min.js"></script>-->
<script type="text/javascript" src="/templates/Home/compiled-templates.js"></script>
<script type="text/javascript">


		$(document).ready(function(){

			var bodyScrollPos; // used for modals, etc..

			var clientDataSource = {"1517":{"Client":{"id":1517,"user_id":102,"unique_code":"102H&SU1NU","intake_form_id":null,"email":"test@gmail.com","first_name":"Alice","last_name":"Smith","birthday":"","anniversary":"","follow_up_date":"April 13, 2016","height":"","age":"","sex":"female","phone":"","shoe_size":"","pant_inseam":"","bust":"","waist":"","hips":"","descriptive_words":"","body_shape":0,"face_shape":0,"street_address":"","city":"Oakland","state":"CA","zipcode":"","country":"USA","notes":null,"stripe_cust_id":"cus_6z7mIuqTPBQ5M2","platform_stripe_cust_id":null,"created":"2014-09-20 15:17:42","modified":"2018-01-13 02:47:48","hasFollowUpDate":1,"follow_up_date_formatted":20160413},"ClientsPhoto":[{"id":100,"client_id":1517,"filename":"1517_554bae9da81ed.jpg","is_primary":1,"x":277,"y":65,"width":379,"height":379,"created":"2015-05-07 12:27:41","modified":"2015-05-12 18:51:56","timestamp":1518883054}],"Closet":{"id":1496,"user_id":102,"client_id":1517,"slug":"102H&SU1NU","show_closet":1,"show_lookbook":1,"show_uploads":1,"comments_disabled":0,"is_stickied":1,"sticky_date":null,"position":0,"has_password":0,"password":null,"title":null,"header_image":null,"description":null,"created":"2014-09-20 15:17:42","modified":"2018-02-12 09:29:52","ClosetSection":[{"id":16115,"closet_id":1496,"is_lookbook_section":1,"is_owned_section":0,"title":"upcoming","position":0,"created":"2016-05-19 10:49:15","modified":"2016-05-19 10:49:15","ClosetSectionsItem":[]},{"id":758,"closet_id":1496,"is_lookbook_section":0,"is_owned_section":1,"title":"My Closet: Items I Own","position":0,"created":"2015-02-06 01:06:20","modified":"2015-02-06 01:06:20","ClosetSectionsItem":[{"id":1478,"closet_sections_id":758},{"id":3893,"closet_sections_id":758},{"id":7183,"closet_sections_id":758},{"id":20727,"closet_sections_id":758},{"id":27103,"closet_sections_id":758},{"id":27977,"closet_sections_id":758},{"id":33111,"closet_sections_id":758},{"id":43323,"closet_sections_id":758},{"id":91268,"closet_sections_id":758},{"id":149107,"closet_sections_id":758}]},{"id":3346,"closet_id":1496,"is_lookbook_section":0,"is_owned_section":1,"title":"Shoes","position":1,"created":"2015-07-24 20:38:36","modified":"2016-06-13 11:52:48","ClosetSectionsItem":[{"id":960,"closet_sections_id":3346},{"id":4537,"closet_sections_id":3346},{"id":43555,"closet_sections_id":3346}]},{"id":1084,"closet_id":1496,"is_lookbook_section":1,"is_owned_section":0,"title":"Spring Trends","position":1,"created":"2015-03-11 11:11:30","modified":"2015-08-28 15:01:23","ClosetSectionsItem":[]},{"id":18527,"closet_id":1496,"is_lookbook_section":0,"is_owned_section":0,"title":"Resources","position":1,"created":"2016-07-13 10:52:35","modified":"2016-07-13 10:52:39","ClosetSectionsItem":[{"id":175041,"closet_sections_id":18527},{"id":175046,"closet_sections_id":18527},{"id":351009,"closet_sections_id":18527},{"id":489270,"closet_sections_id":18527},{"id":491109,"closet_sections_id":18527}]},{"id":784,"closet_id":1496,"is_lookbook_section":0,"is_owned_section":0,"title":"Outfits for a Day Out","position":2,"created":"2015-02-11 09:19:31","modified":"2016-07-13 10:52:39","ClosetSectionsItem":[{"id":7184,"closet_sections_id":784},{"id":7185,"closet_sections_id":784},{"id":7187,"closet_sections_id":784},{"id":7188,"closet_sections_id":784},{"id":7189,"closet_sections_id":784},{"id":7334,"closet_sections_id":784},{"id":7335,"closet_sections_id":784},{"id":7336,"closet_sections_id":784},{"id":13864,"closet_sections_id":784},{"id":13888,"closet_sections_id":784},{"id":14265,"closet_sections_id":784},{"id":15136,"closet_sections_id":784},{"id":17885,"closet_sections_id":784},{"id":19430,"closet_sections_id":784},{"id":19433,"closet_sections_id":784},{"id":22496,"closet_sections_id":784},{"id":26838,"closet_sections_id":784},{"id":27947,"closet_sections_id":784},{"id":33314,"closet_sections_id":784},{"id":33315,"closet_sections_id":784},{"id":36474,"closet_sections_id":784},{"id":38965,"closet_sections_id":784},{"id":43321,"closet_sections_id":784},{"id":49892,"closet_sections_id":784},{"id":65290,"closet_sections_id":784},{"id":67533,"closet_sections_id":784},{"id":73268,"closet_sections_id":784},{"id":77158,"closet_sections_id":784},{"id":105399,"closet_sections_id":784},{"id":114592,"closet_sections_id":784},{"id":121619,"closet_sections_id":784},{"id":121632,"closet_sections_id":784},{"id":139133,"closet_sections_id":784},{"id":148189,"closet_sections_id":784},{"id":148190,"closet_sections_id":784},{"id":349267,"closet_sections_id":784},{"id":440544,"closet_sections_id":784},{"id":488531,"closet_sections_id":784},{"id":491144,"closet_sections_id":784},{"id":506135,"closet_sections_id":784},{"id":516854,"closet_sections_id":784}]},{"id":785,"closet_id":1496,"is_lookbook_section":1,"is_owned_section":0,"title":"Day Out","position":2,"created":"2015-02-11 09:32:24","modified":"2015-08-28 15:01:23","ClosetSectionsItem":[]},{"id":3278,"closet_id":1496,"is_lookbook_section":0,"is_owned_section":1,"title":"Colorful Patterns","position":2,"created":"2015-07-22 22:58:09","modified":"2016-06-13 11:52:48","ClosetSectionsItem":[{"id":17886,"closet_sections_id":3278}]},{"id":76,"closet_id":1496,"is_lookbook_section":0,"is_owned_section":0,"title":"Sample Section","position":3,"created":"2014-09-26 11:13:40","modified":"2018-02-08 12:24:16","ClosetSectionsItem":[{"id":958,"closet_sections_id":76},{"id":963,"closet_sections_id":76},{"id":1074,"closet_sections_id":76},{"id":1075,"closet_sections_id":76},{"id":1102,"closet_sections_id":76},{"id":1310,"closet_sections_id":76},{"id":1319,"closet_sections_id":76},{"id":1409,"closet_sections_id":76},{"id":3356,"closet_sections_id":76},{"id":4384,"closet_sections_id":76},{"id":4770,"closet_sections_id":76},{"id":4779,"closet_sections_id":76},{"id":4870,"closet_sections_id":76},{"id":5486,"closet_sections_id":76},{"id":5764,"closet_sections_id":76},{"id":6771,"closet_sections_id":76},{"id":6773,"closet_sections_id":76},{"id":6779,"closet_sections_id":76},{"id":6785,"closet_sections_id":76},{"id":7679,"closet_sections_id":76},{"id":7784,"closet_sections_id":76},{"id":7810,"closet_sections_id":76},{"id":9418,"closet_sections_id":76},{"id":9419,"closet_sections_id":76},{"id":10127,"closet_sections_id":76},{"id":10625,"closet_sections_id":76},{"id":10627,"closet_sections_id":76},{"id":10651,"closet_sections_id":76},{"id":11030,"closet_sections_id":76},{"id":11129,"closet_sections_id":76},{"id":13084,"closet_sections_id":76},{"id":16657,"closet_sections_id":76},{"id":18816,"closet_sections_id":76},{"id":18817,"closet_sections_id":76},{"id":19442,"closet_sections_id":76},{"id":19443,"closet_sections_id":76},{"id":19559,"closet_sections_id":76},{"id":20921,"closet_sections_id":76},{"id":22213,"closet_sections_id":76},{"id":22422,"closet_sections_id":76},{"id":37636,"closet_sections_id":76},{"id":37675,"closet_sections_id":76},{"id":39741,"closet_sections_id":76},{"id":41844,"closet_sections_id":76},{"id":41847,"closet_sections_id":76},{"id":43316,"closet_sections_id":76},{"id":43627,"closet_sections_id":76},{"id":47089,"closet_sections_id":76},{"id":49890,"closet_sections_id":76},{"id":49894,"closet_sections_id":76},{"id":54968,"closet_sections_id":76},{"id":73271,"closet_sections_id":76},{"id":75525,"closet_sections_id":76},{"id":163456,"closet_sections_id":76},{"id":343808,"closet_sections_id":76},{"id":492294,"closet_sections_id":76}]},{"id":3300,"closet_id":1496,"is_lookbook_section":0,"is_owned_section":1,"title":"Accessories","position":3,"created":"2015-07-23 16:26:25","modified":"2016-06-13 11:52:48","ClosetSectionsItem":[{"id":7186,"closet_sections_id":3300},{"id":7806,"closet_sections_id":3300},{"id":7807,"closet_sections_id":3300},{"id":7808,"closet_sections_id":3300},{"id":8775,"closet_sections_id":3300}]},{"id":503,"closet_id":1496,"is_lookbook_section":1,"is_owned_section":0,"title":"Looks 1","position":3,"created":"2015-01-15 09:20:25","modified":"2015-08-28 15:01:23","ClosetSectionsItem":[]},{"id":4921,"closet_id":1496,"is_lookbook_section":0,"is_owned_section":0,"title":"Fabric swatches","position":4,"created":"2015-09-02 13:54:44","modified":"2016-07-13 10:52:39","ClosetSectionsItem":[{"id":45345,"closet_sections_id":4921},{"id":45347,"closet_sections_id":4921},{"id":49888,"closet_sections_id":4921},{"id":49893,"closet_sections_id":4921}]},{"id":3277,"closet_id":1496,"is_lookbook_section":0,"is_owned_section":1,"title":"Summerwear","position":4,"created":"2015-07-22 22:57:26","modified":"2016-06-13 11:52:48","ClosetSectionsItem":[{"id":10019,"closet_sections_id":3277},{"id":17634,"closet_sections_id":3277},{"id":35532,"closet_sections_id":3277},{"id":43595,"closet_sections_id":3277}]},{"id":58,"closet_id":1496,"is_lookbook_section":0,"is_owned_section":0,"title":"Fallwear","position":5,"created":"2014-09-20 15:18:02","modified":"2016-07-13 10:52:39","ClosetSectionsItem":[{"id":257,"closet_sections_id":58},{"id":265,"closet_sections_id":58},{"id":306,"closet_sections_id":58},{"id":312,"closet_sections_id":58},{"id":525,"closet_sections_id":58},{"id":823,"closet_sections_id":58},{"id":965,"closet_sections_id":58},{"id":3340,"closet_sections_id":58},{"id":5048,"closet_sections_id":58},{"id":5195,"closet_sections_id":58},{"id":6767,"closet_sections_id":58},{"id":6768,"closet_sections_id":58},{"id":6770,"closet_sections_id":58},{"id":6782,"closet_sections_id":58},{"id":10020,"closet_sections_id":58},{"id":15135,"closet_sections_id":58},{"id":17988,"closet_sections_id":58},{"id":24177,"closet_sections_id":58},{"id":31714,"closet_sections_id":58},{"id":31729,"closet_sections_id":58},{"id":43364,"closet_sections_id":58},{"id":45360,"closet_sections_id":58},{"id":45857,"closet_sections_id":58},{"id":45859,"closet_sections_id":58},{"id":45860,"closet_sections_id":58},{"id":49889,"closet_sections_id":58},{"id":62300,"closet_sections_id":58},{"id":200071,"closet_sections_id":58}]},{"id":4680,"closet_id":1496,"is_lookbook_section":0,"is_owned_section":1,"title":"Style This","position":5,"created":"2015-08-27 18:07:32","modified":"2016-06-13 11:52:48","ClosetSectionsItem":[{"id":7809,"closet_sections_id":4680}]}],"NotificationEvent":[]},"hasMultiplePhotos":false},"1569":{"Client":{"id":1569,"user_id":102,"unique_code":"102H&SktIk","intake_form_id":null,"email":"test2@gmail.com","first_name":"Jane","last_name":"Bartlett","birthday":null,"anniversary":null,"follow_up_date":0,"height":"","age":"","sex":"female","phone":"","shoe_size":"","pant_inseam":"","bust":"","waist":"","hips":"","descriptive_words":"","body_shape":0,"face_shape":0,"street_address":"","city":"New York","state":"NY","zipcode":"","country":"USA","notes":"Time more important than money.  High up in an accounting firm.  Personality is more reserved.","stripe_cust_id":null,"platform_stripe_cust_id":null,"created":"2014-10-23 10:43:10","modified":"2015-07-23 17:23:02","hasFollowUpDate":0,"follow_up_date_formatted":""},"ClientsPhoto":[{"id":77,"client_id":1569,"filename":"1569_554af9501df18.jpg","is_primary":1,"x":0,"y":0,"width":653,"height":653,"created":"2015-05-06 23:34:08","modified":"2015-07-08 09:04:21","timestamp":1518883054}],"Closet":{"id":1548,"user_id":102,"client_id":1569,"slug":"102H&SktIk","show_closet":0,"show_lookbook":1,"show_uploads":0,"comments_disabled":0,"is_stickied":0,"sticky_date":null,"position":3,"has_password":0,"password":null,"title":null,"header_image":null,"description":null,"created":"2014-10-23 10:43:10","modified":"2017-12-13 09:08:27","ClosetSection":[{"id":1294,"closet_id":1548,"is_lookbook_section":1,"is_owned_section":0,"title":"Assorted Looks","position":0,"created":"2015-03-24 11:22:39","modified":"2015-07-29 15:09:53","ClosetSectionsItem":[]},{"id":497,"closet_id":1548,"is_lookbook_section":1,"is_owned_section":0,"title":"Addtional Looks","position":0,"created":"2015-01-15 08:50:28","modified":"2015-07-29 15:10:13","ClosetSectionsItem":[]},{"id":764,"closet_id":1548,"is_lookbook_section":0,"is_owned_section":1,"title":"My Closet: Items I Own","position":0,"created":"2015-02-06 19:42:03","modified":"2015-02-06 19:42:03","ClosetSectionsItem":[{"id":1457,"closet_sections_id":764},{"id":91262,"closet_sections_id":764}]},{"id":134,"closet_id":1548,"is_lookbook_section":0,"is_owned_section":0,"title":"Winterwear","position":1,"created":"2014-10-23 10:45:23","modified":"2015-08-29 11:29:04","ClosetSectionsItem":[{"id":920,"closet_sections_id":134},{"id":922,"closet_sections_id":134},{"id":3024,"closet_sections_id":134},{"id":4353,"closet_sections_id":134},{"id":5047,"closet_sections_id":134},{"id":6774,"closet_sections_id":134},{"id":11506,"closet_sections_id":134},{"id":43577,"closet_sections_id":134},{"id":43601,"closet_sections_id":134},{"id":43997,"closet_sections_id":134},{"id":60870,"closet_sections_id":134},{"id":60879,"closet_sections_id":134},{"id":78774,"closet_sections_id":134},{"id":110879,"closet_sections_id":134},{"id":157088,"closet_sections_id":134},{"id":469450,"closet_sections_id":134},{"id":469451,"closet_sections_id":134}]},{"id":174,"closet_id":1548,"is_lookbook_section":0,"is_owned_section":0,"title":"2014 - 2Outfit","position":2,"created":"2014-11-04 15:50:52","modified":"2015-08-29 11:29:25","ClosetSectionsItem":[{"id":1341,"closet_sections_id":174},{"id":1342,"closet_sections_id":174},{"id":4484,"closet_sections_id":174},{"id":4535,"closet_sections_id":174},{"id":6772,"closet_sections_id":174},{"id":7811,"closet_sections_id":174},{"id":7968,"closet_sections_id":174},{"id":11510,"closet_sections_id":174},{"id":13863,"closet_sections_id":174},{"id":35774,"closet_sections_id":174},{"id":35783,"closet_sections_id":174},{"id":36217,"closet_sections_id":174},{"id":36505,"closet_sections_id":174},{"id":36528,"closet_sections_id":174},{"id":43318,"closet_sections_id":174},{"id":43623,"closet_sections_id":174},{"id":45398,"closet_sections_id":174},{"id":113253,"closet_sections_id":174},{"id":253078,"closet_sections_id":174},{"id":348208,"closet_sections_id":174},{"id":478390,"closet_sections_id":174}]}],"NotificationEvent":[]},"hasMultiplePhotos":false},"1583":{"Client":{"id":1583,"user_id":102,"unique_code":"102H&SWVxc","intake_form_id":null,"email":"clientemail@gmail.com","first_name":"Emma","last_name":"Rock","birthday":"","anniversary":"","follow_up_date":"March 22, 2018","height":"5'5","age":27,"sex":"female","phone":"(123) 456-7890","shoe_size":"","pant_inseam":"","bust":"","waist":"","hips":"","descriptive_words":"","body_shape":0,"face_shape":0,"street_address":"","city":"Scottsdale","state":"AZ","zipcode":"","country":"USA","notes":"Do a wardrobe refresh this spring\n\nHelped her prepare for her promotional tour\n\n","stripe_cust_id":null,"platform_stripe_cust_id":null,"created":"2014-11-07 13:21:59","modified":"2018-02-16 11:37:52","hasFollowUpDate":1,"follow_up_date_formatted":20180322},"ClientsPhoto":[{"id":1762,"client_id":1583,"filename":"1583_587e87cc32364.jpg","is_primary":1,"x":0,"y":0,"width":980,"height":980,"created":"2017-01-17 14:08:28","modified":"2017-01-17 14:08:28","timestamp":1518883054}],"Closet":{"id":1570,"user_id":102,"client_id":1583,"slug":"102H&SWVxc","show_closet":1,"show_lookbook":1,"show_uploads":1,"comments_disabled":0,"is_stickied":0,"sticky_date":null,"position":3,"has_password":0,"password":null,"title":null,"header_image":null,"description":null,"created":"2014-11-07 13:21:59","modified":"2018-02-15 07:57:32","ClosetSection":[{"id":49667,"closet_id":1570,"is_lookbook_section":1,"is_owned_section":0,"title":"Looks for 2018","position":0,"created":"2018-01-10 11:45:03","modified":"2018-01-10 11:45:03","ClosetSectionsItem":[]},{"id":24012,"closet_id":1570,"is_lookbook_section":1,"is_owned_section":0,"title":"Looks for 2017","position":0,"created":"2016-10-26 16:33:03","modified":"2016-10-27 16:49:47","ClosetSectionsItem":[]},{"id":759,"closet_id":1570,"is_lookbook_section":0,"is_owned_section":1,"title":"My Closet: Items I Own","position":0,"created":"2015-02-06 01:07:29","modified":"2015-02-06 01:07:29","ClosetSectionsItem":[{"id":36529,"closet_sections_id":759},{"id":43387,"closet_sections_id":759},{"id":146463,"closet_sections_id":759},{"id":196937,"closet_sections_id":759},{"id":228360,"closet_sections_id":759},{"id":310025,"closet_sections_id":759},{"id":349266,"closet_sections_id":759},{"id":349718,"closet_sections_id":759},{"id":481531,"closet_sections_id":759},{"id":493098,"closet_sections_id":759},{"id":506783,"closet_sections_id":759}]},{"id":14191,"closet_id":1570,"is_lookbook_section":0,"is_owned_section":1,"title":"What Do I Wear With This?","position":1,"created":"2016-04-13 10:36:40","modified":"2017-10-03 10:10:46","ClosetSectionsItem":[{"id":23440,"closet_sections_id":14191},{"id":23441,"closet_sections_id":14191},{"id":85633,"closet_sections_id":14191},{"id":96866,"closet_sections_id":14191},{"id":102304,"closet_sections_id":14191},{"id":106415,"closet_sections_id":14191},{"id":143846,"closet_sections_id":14191}]},{"id":11676,"closet_id":1570,"is_lookbook_section":1,"is_owned_section":0,"title":"Miami Trip 2015","position":1,"created":"2016-02-27 16:48:58","modified":"2016-03-02 14:29:57","ClosetSectionsItem":[]},{"id":189,"closet_id":1570,"is_lookbook_section":0,"is_owned_section":0,"title":"Wardrobe Update","position":1,"created":"2014-11-10 12:35:43","modified":"2018-01-13 15:05:31","ClosetSectionsItem":[{"id":2124,"closet_sections_id":189},{"id":4143,"closet_sections_id":189},{"id":4483,"closet_sections_id":189},{"id":8972,"closet_sections_id":189},{"id":9321,"closet_sections_id":189},{"id":16249,"closet_sections_id":189},{"id":32933,"closet_sections_id":189},{"id":43571,"closet_sections_id":189},{"id":43592,"closet_sections_id":189},{"id":43594,"closet_sections_id":189},{"id":43596,"closet_sections_id":189},{"id":43599,"closet_sections_id":189},{"id":44059,"closet_sections_id":189},{"id":47897,"closet_sections_id":189},{"id":59629,"closet_sections_id":189},{"id":85879,"closet_sections_id":189},{"id":93945,"closet_sections_id":189},{"id":106416,"closet_sections_id":189},{"id":114539,"closet_sections_id":189},{"id":114594,"closet_sections_id":189},{"id":127294,"closet_sections_id":189},{"id":164166,"closet_sections_id":189},{"id":170383,"closet_sections_id":189},{"id":182338,"closet_sections_id":189},{"id":183080,"closet_sections_id":189},{"id":224042,"closet_sections_id":189},{"id":263073,"closet_sections_id":189},{"id":278281,"closet_sections_id":189},{"id":295438,"closet_sections_id":189},{"id":299142,"closet_sections_id":189},{"id":308544,"closet_sections_id":189},{"id":310026,"closet_sections_id":189},{"id":314973,"closet_sections_id":189},{"id":320289,"closet_sections_id":189},{"id":321023,"closet_sections_id":189},{"id":349717,"closet_sections_id":189},{"id":384134,"closet_sections_id":189},{"id":386246,"closet_sections_id":189},{"id":392953,"closet_sections_id":189},{"id":392956,"closet_sections_id":189},{"id":394702,"closet_sections_id":189},{"id":394703,"closet_sections_id":189},{"id":401009,"closet_sections_id":189},{"id":425034,"closet_sections_id":189},{"id":457292,"closet_sections_id":189},{"id":473997,"closet_sections_id":189},{"id":474063,"closet_sections_id":189},{"id":482673,"closet_sections_id":189},{"id":487660,"closet_sections_id":189},{"id":491242,"closet_sections_id":189},{"id":492017,"closet_sections_id":189},{"id":492222,"closet_sections_id":189},{"id":501429,"closet_sections_id":189},{"id":501512,"closet_sections_id":189},{"id":506134,"closet_sections_id":189},{"id":517608,"closet_sections_id":189},{"id":517821,"closet_sections_id":189}]},{"id":1025,"closet_id":1570,"is_lookbook_section":1,"is_owned_section":0,"title":"Traditional Looks","position":2,"created":"2015-03-06 11:48:02","modified":"2016-06-28 09:03:51","ClosetSectionsItem":[]},{"id":4703,"closet_id":1570,"is_lookbook_section":0,"is_owned_section":1,"title":"Dresses","position":2,"created":"2015-08-28 12:03:00","modified":"2017-10-03 10:10:46","ClosetSectionsItem":[{"id":11031,"closet_sections_id":4703},{"id":11034,"closet_sections_id":4703},{"id":11494,"closet_sections_id":4703},{"id":17519,"closet_sections_id":4703},{"id":321712,"closet_sections_id":4703},{"id":439266,"closet_sections_id":4703}]},{"id":14192,"closet_id":1570,"is_lookbook_section":0,"is_owned_section":0,"title":"Whatever You Like","position":2,"created":"2016-04-13 10:43:28","modified":"2018-01-13 15:05:31","ClosetSectionsItem":[{"id":142190,"closet_sections_id":14192},{"id":142191,"closet_sections_id":14192},{"id":149324,"closet_sections_id":14192},{"id":161003,"closet_sections_id":14192},{"id":162545,"closet_sections_id":14192},{"id":162549,"closet_sections_id":14192},{"id":169015,"closet_sections_id":14192},{"id":178130,"closet_sections_id":14192},{"id":178134,"closet_sections_id":14192},{"id":199162,"closet_sections_id":14192},{"id":209403,"closet_sections_id":14192},{"id":213935,"closet_sections_id":14192},{"id":218960,"closet_sections_id":14192},{"id":220068,"closet_sections_id":14192},{"id":220075,"closet_sections_id":14192},{"id":220380,"closet_sections_id":14192},{"id":228361,"closet_sections_id":14192},{"id":229886,"closet_sections_id":14192},{"id":242091,"closet_sections_id":14192},{"id":248487,"closet_sections_id":14192},{"id":248883,"closet_sections_id":14192},{"id":253077,"closet_sections_id":14192},{"id":261936,"closet_sections_id":14192},{"id":265020,"closet_sections_id":14192},{"id":268241,"closet_sections_id":14192},{"id":269033,"closet_sections_id":14192},{"id":271080,"closet_sections_id":14192},{"id":275225,"closet_sections_id":14192},{"id":275233,"closet_sections_id":14192},{"id":277086,"closet_sections_id":14192},{"id":277303,"closet_sections_id":14192},{"id":277306,"closet_sections_id":14192},{"id":279492,"closet_sections_id":14192},{"id":286555,"closet_sections_id":14192},{"id":286722,"closet_sections_id":14192},{"id":287661,"closet_sections_id":14192},{"id":299831,"closet_sections_id":14192},{"id":300207,"closet_sections_id":14192},{"id":329639,"closet_sections_id":14192},{"id":337337,"closet_sections_id":14192},{"id":343807,"closet_sections_id":14192},{"id":384181,"closet_sections_id":14192},{"id":392957,"closet_sections_id":14192},{"id":405662,"closet_sections_id":14192},{"id":405690,"closet_sections_id":14192},{"id":405742,"closet_sections_id":14192},{"id":409817,"closet_sections_id":14192},{"id":414420,"closet_sections_id":14192},{"id":427465,"closet_sections_id":14192},{"id":427466,"closet_sections_id":14192},{"id":440543,"closet_sections_id":14192},{"id":443013,"closet_sections_id":14192},{"id":446992,"closet_sections_id":14192},{"id":478388,"closet_sections_id":14192},{"id":483123,"closet_sections_id":14192},{"id":493141,"closet_sections_id":14192},{"id":494458,"closet_sections_id":14192},{"id":495524,"closet_sections_id":14192},{"id":504331,"closet_sections_id":14192},{"id":506785,"closet_sections_id":14192},{"id":517822,"closet_sections_id":14192},{"id":517911,"closet_sections_id":14192},{"id":518496,"closet_sections_id":14192}]},{"id":11228,"closet_id":1570,"is_lookbook_section":0,"is_owned_section":1,"title":"Tops","position":3,"created":"2016-02-15 08:11:44","modified":"2017-10-03 10:10:46","ClosetSectionsItem":[{"id":23439,"closet_sections_id":11228},{"id":23442,"closet_sections_id":11228}]},{"id":43496,"closet_id":1570,"is_lookbook_section":0,"is_owned_section":1,"title":"Purses","position":5,"created":"2017-10-03 10:10:41","modified":"2017-10-03 10:10:46","ClosetSectionsItem":[]}],"NotificationEvent":[{"id":79792,"closets_id":1570,"event_type_id":2,"looks_id":17482,"comments_id":105522,"closet_sections_items_id":null,"created":"2017-11-30 15:31:10","modified":"2017-11-30 15:31:10"}]},"hasMultiplePhotos":false},"1830":{"Client":{"id":1830,"user_id":102,"unique_code":"102H&SL3oh","intake_form_id":null,"email":"janedoe@gmail.com","first_name":"Jane","last_name":"Doe","birthday":"","anniversary":"","follow_up_date":"March 29, 2017","height":"","age":"","sex":"female","phone":"(949) 273-2373","shoe_size":"","pant_inseam":"","bust":"","waist":"","hips":"","descriptive_words":"","body_shape":0,"face_shape":0,"street_address":"","city":"Santa Monica","state":"CA","zipcode":"","country":"USA","notes":"Wants to work with me again this spring","stripe_cust_id":null,"platform_stripe_cust_id":null,"created":"2015-03-19 15:03:25","modified":"2018-02-14 09:59:17","hasFollowUpDate":1,"follow_up_date_formatted":20170329},"ClientsPhoto":[{"id":76,"client_id":1830,"filename":"1830_554af9323f5c3.jpg","is_primary":1,"x":0,"y":0,"width":735,"height":735,"created":"2015-05-06 23:33:38","modified":"2015-05-06 23:33:47","timestamp":1518883054}],"Closet":{"id":1921,"user_id":102,"client_id":1830,"slug":"102H&SL3oh","show_closet":1,"show_lookbook":1,"show_uploads":1,"comments_disabled":0,"is_stickied":0,"sticky_date":null,"position":0,"has_password":0,"password":null,"title":null,"header_image":null,"description":null,"created":"2015-03-19 15:03:25","modified":"2018-02-13 12:05:12","ClosetSection":[{"id":1917,"closet_id":1921,"is_lookbook_section":0,"is_owned_section":1,"title":"My Closet: Items I Own","position":0,"created":"2015-05-06 18:03:23","modified":"2015-05-06 18:03:23","ClosetSectionsItem":[{"id":22742,"closet_sections_id":1917},{"id":29195,"closet_sections_id":1917},{"id":29196,"closet_sections_id":1917},{"id":29197,"closet_sections_id":1917},{"id":29198,"closet_sections_id":1917},{"id":411932,"closet_sections_id":1917},{"id":411933,"closet_sections_id":1917},{"id":411934,"closet_sections_id":1917},{"id":411935,"closet_sections_id":1917},{"id":411936,"closet_sections_id":1917}]},{"id":4994,"closet_id":1921,"is_lookbook_section":0,"is_owned_section":1,"title":"skirts","position":0,"created":"2015-09-04 14:41:50","modified":"2015-09-04 14:41:50","ClosetSectionsItem":[{"id":22210,"closet_sections_id":4994}]},{"id":18328,"closet_id":1921,"is_lookbook_section":0,"is_owned_section":1,"title":"Dresses","position":0,"created":"2016-07-09 06:37:05","modified":"2016-07-09 06:37:05","ClosetSectionsItem":[{"id":45970,"closet_sections_id":18328}]},{"id":4393,"closet_id":1921,"is_lookbook_section":1,"is_owned_section":0,"title":"New Outfits","position":1,"created":"2015-08-17 14:53:53","modified":"2017-04-21 09:31:23","ClosetSectionsItem":[]},{"id":24905,"closet_id":1921,"is_lookbook_section":0,"is_owned_section":0,"title":"Holiday Picks","position":1,"created":"2016-11-09 10:42:38","modified":"2017-04-21 09:31:20","ClosetSectionsItem":[{"id":256977,"closet_sections_id":24905},{"id":278290,"closet_sections_id":24905},{"id":295439,"closet_sections_id":24905},{"id":302230,"closet_sections_id":24905},{"id":324223,"closet_sections_id":24905},{"id":344611,"closet_sections_id":24905},{"id":371958,"closet_sections_id":24905},{"id":371970,"closet_sections_id":24905},{"id":446986,"closet_sections_id":24905},{"id":470668,"closet_sections_id":24905},{"id":471548,"closet_sections_id":24905},{"id":473495,"closet_sections_id":24905}]},{"id":32856,"closet_id":1921,"is_lookbook_section":1,"is_owned_section":0,"title":"Old Outfits","position":2,"created":"2017-04-21 09:31:18","modified":"2017-04-21 09:31:23","ClosetSectionsItem":[]},{"id":1226,"closet_id":1921,"is_lookbook_section":0,"is_owned_section":0,"title":"New Items","position":2,"created":"2015-03-19 15:04:00","modified":"2017-04-21 09:31:20","ClosetSectionsItem":[{"id":11140,"closet_sections_id":1226},{"id":11142,"closet_sections_id":1226},{"id":20544,"closet_sections_id":1226},{"id":20925,"closet_sections_id":1226},{"id":21031,"closet_sections_id":1226},{"id":22495,"closet_sections_id":1226},{"id":23593,"closet_sections_id":1226},{"id":23607,"closet_sections_id":1226},{"id":26843,"closet_sections_id":1226},{"id":29731,"closet_sections_id":1226},{"id":31795,"closet_sections_id":1226},{"id":31796,"closet_sections_id":1226},{"id":32874,"closet_sections_id":1226},{"id":32875,"closet_sections_id":1226},{"id":32932,"closet_sections_id":1226},{"id":32992,"closet_sections_id":1226},{"id":33032,"closet_sections_id":1226},{"id":33157,"closet_sections_id":1226},{"id":33178,"closet_sections_id":1226},{"id":33208,"closet_sections_id":1226},{"id":33294,"closet_sections_id":1226},{"id":33295,"closet_sections_id":1226},{"id":33406,"closet_sections_id":1226},{"id":37638,"closet_sections_id":1226},{"id":43998,"closet_sections_id":1226},{"id":45269,"closet_sections_id":1226},{"id":51217,"closet_sections_id":1226},{"id":54106,"closet_sections_id":1226},{"id":55696,"closet_sections_id":1226},{"id":58836,"closet_sections_id":1226},{"id":62302,"closet_sections_id":1226},{"id":63891,"closet_sections_id":1226},{"id":64830,"closet_sections_id":1226},{"id":78767,"closet_sections_id":1226},{"id":114262,"closet_sections_id":1226},{"id":114860,"closet_sections_id":1226},{"id":126965,"closet_sections_id":1226},{"id":126966,"closet_sections_id":1226},{"id":162547,"closet_sections_id":1226},{"id":191624,"closet_sections_id":1226},{"id":199164,"closet_sections_id":1226},{"id":216012,"closet_sections_id":1226},{"id":218396,"closet_sections_id":1226},{"id":236609,"closet_sections_id":1226},{"id":236618,"closet_sections_id":1226},{"id":236626,"closet_sections_id":1226},{"id":286556,"closet_sections_id":1226},{"id":286723,"closet_sections_id":1226},{"id":386219,"closet_sections_id":1226},{"id":471651,"closet_sections_id":1226},{"id":471652,"closet_sections_id":1226}]}],"NotificationEvent":[]},"hasMultiplePhotos":false},"2124":{"Client":{"id":2124,"user_id":102,"unique_code":"102H&SigHq","intake_form_id":null,"email":"john.doe@gmail.com","first_name":"John","last_name":"Doe","birthday":"","anniversary":"","follow_up_date":"August 23, 2017","height":"5'10","age":39,"sex":"male","phone":"(800) 123-6787","shoe_size":"","pant_inseam":"","bust":"","waist":"","hips":"","descriptive_words":"","body_shape":0,"face_shape":0,"street_address":"419 My Lane","city":"Columbus","state":"OH","zipcode":60131,"country":"USA","notes":"In the middle of a job transition. Needs help to look his best during his job interviews. ","stripe_cust_id":null,"platform_stripe_cust_id":null,"created":"2015-06-25 09:51:47","modified":"2018-02-02 09:48:02","hasFollowUpDate":1,"follow_up_date_formatted":20170823},"ClientsPhoto":[{"id":207,"client_id":2124,"filename":"2124_558c2394c4cbe.jpg","is_primary":1,"x":6,"y":0,"width":120,"height":120,"created":"2015-06-25 09:51:48","modified":"2015-06-25 09:51:48","timestamp":1518883054}],"Closet":{"id":2296,"user_id":102,"client_id":2124,"slug":"102H&SigHq","show_closet":1,"show_lookbook":1,"show_uploads":1,"comments_disabled":0,"is_stickied":0,"sticky_date":null,"position":0,"has_password":0,"password":null,"title":null,"header_image":null,"description":null,"created":"2015-06-25 09:51:47","modified":"2018-02-14 04:32:22","ClosetSection":[{"id":2677,"closet_id":2296,"is_lookbook_section":0,"is_owned_section":1,"title":"Unsorted Closet Uploads","position":0,"created":"2015-06-25 09:54:08","modified":"2015-06-25 09:54:08","ClosetSectionsItem":[{"id":29212,"closet_sections_id":2677},{"id":29213,"closet_sections_id":2677},{"id":29214,"closet_sections_id":2677},{"id":58785,"closet_sections_id":2677},{"id":58787,"closet_sections_id":2677},{"id":58788,"closet_sections_id":2677},{"id":58789,"closet_sections_id":2677},{"id":120826,"closet_sections_id":2677}]},{"id":2678,"closet_id":2296,"is_lookbook_section":1,"is_owned_section":0,"title":"Interview Options","position":1,"created":"2015-06-25 09:55:30","modified":"2017-10-18 09:26:02","ClosetSectionsItem":[]},{"id":2679,"closet_id":2296,"is_lookbook_section":0,"is_owned_section":0,"title":"Promotion Needs","position":1,"created":"2015-06-25 09:56:36","modified":"2017-08-16 20:26:59","ClosetSectionsItem":[{"id":33166,"closet_sections_id":2679},{"id":33890,"closet_sections_id":2679},{"id":35644,"closet_sections_id":2679},{"id":35645,"closet_sections_id":2679},{"id":45979,"closet_sections_id":2679},{"id":51150,"closet_sections_id":2679},{"id":60520,"closet_sections_id":2679},{"id":85880,"closet_sections_id":2679},{"id":93178,"closet_sections_id":2679},{"id":93179,"closet_sections_id":2679},{"id":100601,"closet_sections_id":2679},{"id":101074,"closet_sections_id":2679},{"id":108859,"closet_sections_id":2679},{"id":136919,"closet_sections_id":2679},{"id":205642,"closet_sections_id":2679},{"id":206843,"closet_sections_id":2679},{"id":275230,"closet_sections_id":2679},{"id":396103,"closet_sections_id":2679},{"id":396105,"closet_sections_id":2679},{"id":446415,"closet_sections_id":2679},{"id":490940,"closet_sections_id":2679},{"id":491088,"closet_sections_id":2679},{"id":491240,"closet_sections_id":2679},{"id":492015,"closet_sections_id":2679},{"id":494696,"closet_sections_id":2679},{"id":494699,"closet_sections_id":2679},{"id":495102,"closet_sections_id":2679},{"id":516561,"closet_sections_id":2679}]},{"id":40410,"closet_id":2296,"is_lookbook_section":1,"is_owned_section":0,"title":"Transitional Outfits","position":2,"created":"2017-08-16 20:26:57","modified":"2017-08-16 20:27:09","ClosetSectionsItem":[]},{"id":40060,"closet_id":2296,"is_lookbook_section":1,"is_owned_section":0,"title":"Presentation Outfits","position":3,"created":"2017-08-10 15:30:08","modified":"2017-08-16 20:27:09","ClosetSectionsItem":[]}],"NotificationEvent":[]},"hasMultiplePhotos":false},"3838":{"Client":{"id":3838,"user_id":102,"unique_code":"102H&SCoDy","intake_form_id":null,"email":"joshmo@gmail.com","first_name":"Joe","last_name":"Shmo","birthday":"","anniversary":"","follow_up_date":"April 29, 2016","height":"","age":"","sex":"","phone":"","shoe_size":6,"pant_inseam":50,"bust":34,"waist":32,"hips":33,"descriptive_words":"","body_shape":0,"face_shape":0,"street_address":"","city":"youngstown","state":"AL","zipcode":"","country":"USA","notes":null,"stripe_cust_id":null,"platform_stripe_cust_id":null,"created":"2016-04-25 16:28:29","modified":"2017-12-21 03:05:55","hasFollowUpDate":1,"follow_up_date_formatted":20160429},"ClientsPhoto":[],"Closet":{"id":4532,"user_id":102,"client_id":3838,"slug":"102H&SCoDy","show_closet":1,"show_lookbook":1,"show_uploads":1,"comments_disabled":0,"is_stickied":0,"sticky_date":null,"position":0,"has_password":0,"password":null,"title":null,"header_image":null,"description":null,"created":"2016-04-25 16:28:29","modified":"2018-02-13 12:05:10","ClosetSection":[{"id":14891,"closet_id":4532,"is_lookbook_section":0,"is_owned_section":1,"title":"Recent Uploads","position":0,"created":"2016-04-25 16:28:29","modified":"2016-04-25 16:28:29","ClosetSectionsItem":[{"id":191572,"closet_sections_id":14891},{"id":191573,"closet_sections_id":14891},{"id":191575,"closet_sections_id":14891},{"id":191576,"closet_sections_id":14891},{"id":191577,"closet_sections_id":14891},{"id":191578,"closet_sections_id":14891},{"id":191579,"closet_sections_id":14891},{"id":191580,"closet_sections_id":14891},{"id":191581,"closet_sections_id":14891},{"id":191582,"closet_sections_id":14891},{"id":191583,"closet_sections_id":14891},{"id":191584,"closet_sections_id":14891},{"id":191585,"closet_sections_id":14891},{"id":191586,"closet_sections_id":14891},{"id":191587,"closet_sections_id":14891},{"id":191588,"closet_sections_id":14891}]},{"id":21724,"closet_id":4532,"is_lookbook_section":1,"is_owned_section":0,"title":"Fun Attire","position":0,"created":"2016-09-16 11:10:00","modified":"2016-09-16 11:10:00","ClosetSectionsItem":[]},{"id":14890,"closet_id":4532,"is_lookbook_section":0,"is_owned_section":0,"title":"Outdoors Gear","position":1,"created":"2016-04-25 16:28:29","modified":"2017-03-16 13:52:47","ClosetSectionsItem":[{"id":199158,"closet_sections_id":14890},{"id":199159,"closet_sections_id":14890},{"id":204408,"closet_sections_id":14890},{"id":204883,"closet_sections_id":14890},{"id":223688,"closet_sections_id":14890},{"id":256976,"closet_sections_id":14890},{"id":265015,"closet_sections_id":14890},{"id":276875,"closet_sections_id":14890},{"id":295857,"closet_sections_id":14890},{"id":303002,"closet_sections_id":14890},{"id":351010,"closet_sections_id":14890},{"id":367615,"closet_sections_id":14890},{"id":474070,"closet_sections_id":14890},{"id":478387,"closet_sections_id":14890},{"id":481560,"closet_sections_id":14890},{"id":494064,"closet_sections_id":14890},{"id":515995,"closet_sections_id":14890},{"id":517076,"closet_sections_id":14890}]}],"NotificationEvent":[]},"hasMultiplePhotos":false},"3930":{"Client":{"id":3930,"user_id":102,"unique_code":"102H&SIuyJ","intake_form_id":null,"email":"davidp@gmail.com","first_name":"David","last_name":"Penrod","birthday":"","anniversary":"","follow_up_date":0,"height":"","age":"","sex":"","phone":"","shoe_size":"","pant_inseam":"","bust":"","waist":"","hips":null,"descriptive_words":"","body_shape":0,"face_shape":0,"street_address":"","city":"San Francisco","state":"CA","zipcode":"","country":"USA","notes":null,"stripe_cust_id":null,"platform_stripe_cust_id":null,"created":"2016-05-11 09:37:49","modified":"2017-09-13 08:26:55","hasFollowUpDate":0,"follow_up_date_formatted":""},"ClientsPhoto":[],"Closet":{"id":4651,"user_id":102,"client_id":3930,"slug":"102H&SIuyJ","show_closet":1,"show_lookbook":1,"show_uploads":1,"comments_disabled":0,"is_stickied":0,"sticky_date":null,"position":0,"has_password":0,"password":null,"title":null,"header_image":null,"description":null,"created":"2016-05-11 09:37:49","modified":"2017-11-08 11:35:44","ClosetSection":[{"id":15654,"closet_id":4651,"is_lookbook_section":0,"is_owned_section":1,"title":"Recent Uploads","position":0,"created":"2016-05-11 09:37:49","modified":"2016-05-11 09:37:49","ClosetSectionsItem":[{"id":165994,"closet_sections_id":15654},{"id":165995,"closet_sections_id":15654},{"id":165996,"closet_sections_id":15654}]},{"id":17629,"closet_id":4651,"is_lookbook_section":1,"is_owned_section":0,"title":"Example Look","position":0,"created":"2016-06-21 10:03:31","modified":"2016-06-21 10:03:31","ClosetSectionsItem":[]},{"id":15653,"closet_id":4651,"is_lookbook_section":0,"is_owned_section":0,"title":"First Section","position":1,"created":"2016-05-11 09:37:49","modified":"2016-06-21 10:03:33","ClosetSectionsItem":[{"id":147243,"closet_sections_id":15653},{"id":166001,"closet_sections_id":15653},{"id":456073,"closet_sections_id":15653},{"id":456080,"closet_sections_id":15653},{"id":456150,"closet_sections_id":15653}]}],"NotificationEvent":[]},"hasMultiplePhotos":false},"4312":{"Client":{"id":4312,"user_id":102,"unique_code":"102H&SBqMi","intake_form_id":null,"email":"sam@pixie-belle.co.uk","first_name":"Sam","last_name":"Bell","birthday":"","anniversary":"","follow_up_date":"September 1, 2016","height":"152cm","age":38,"sex":"female","phone":"","shoe_size":"","pant_inseam":"","bust":"","waist":"","hips":"","descriptive_words":"","body_shape":0,"face_shape":0,"street_address":"","city":"Yeovil","state":"Somerset","zipcode":"","country":"UK","notes":"Petite, curvy client with an eye for bright colours and clothing with that extra little detail.","stripe_cust_id":null,"platform_stripe_cust_id":null,"created":"2016-08-04 13:45:21","modified":"2018-01-04 02:06:07","hasFollowUpDate":1,"follow_up_date_formatted":20160901},"ClientsPhoto":[],"Closet":{"id":5205,"user_id":102,"client_id":4312,"slug":"102H&SBqMi","show_closet":1,"show_lookbook":0,"show_uploads":1,"comments_disabled":0,"is_stickied":0,"sticky_date":null,"position":0,"has_password":0,"password":null,"title":null,"header_image":null,"description":null,"created":"2016-08-04 13:45:21","modified":"2016-08-04 13:45:21","ClosetSection":[{"id":19498,"closet_id":5205,"is_lookbook_section":0,"is_owned_section":1,"title":"Recent Uploads","position":0,"created":"2016-08-04 13:45:21","modified":"2016-08-04 13:45:21","ClosetSectionsItem":[{"id":183401,"closet_sections_id":19498},{"id":183402,"closet_sections_id":19498},{"id":183403,"closet_sections_id":19498},{"id":183405,"closet_sections_id":19498},{"id":183406,"closet_sections_id":19498},{"id":183407,"closet_sections_id":19498},{"id":183410,"closet_sections_id":19498}]},{"id":19501,"closet_id":5205,"is_lookbook_section":0,"is_owned_section":1,"title":"Sam's Fave Items","position":0,"created":"2016-08-04 13:52:05","modified":"2016-08-04 13:52:05","ClosetSectionsItem":[]},{"id":19497,"closet_id":5205,"is_lookbook_section":0,"is_owned_section":0,"title":"First Section","position":1,"created":"2016-08-04 13:45:21","modified":"2016-08-04 13:52:10","ClosetSectionsItem":[{"id":216269,"closet_sections_id":19497},{"id":216270,"closet_sections_id":19497},{"id":236629,"closet_sections_id":19497},{"id":236630,"closet_sections_id":19497},{"id":269246,"closet_sections_id":19497},{"id":271083,"closet_sections_id":19497},{"id":275226,"closet_sections_id":19497}]}],"NotificationEvent":[]},"hasMultiplePhotos":false},"7040":{"Client":{"id":7040,"user_id":102,"unique_code":"102H&S8bCX","intake_form_id":null,"email":"burodeestilo@icloud.com","first_name":"EDUARDO","last_name":"FERNANDEZ","birthday":"10\/10\/1973","anniversary":"","follow_up_date":0,"height":"","age":44,"sex":"MASCULINO","phone":"","shoe_size":10,"pant_inseam":"","bust":"","waist":"","hips":null,"descriptive_words":"","body_shape":0,"face_shape":0,"street_address":"GUTENBERG 85","city":"Ciudad de M\u00e9xico","state":"M\u00e9xico","zipcode":11560,"country":"M\u00e9xico","notes":"1. Necesito asesor\u00eda en la compra del tipo de pantalones casuales \n2. Tipo de corbatas que puedo usar para combinar con sacos","stripe_cust_id":null,"platform_stripe_cust_id":null,"created":"2017-10-22 12:42:38","modified":"2017-10-22 12:50:26","hasFollowUpDate":0,"follow_up_date_formatted":""},"ClientsPhoto":[{"id":2848,"client_id":7040,"filename":"7040_59ece71b22c63.jpg","is_primary":1,"x":0,"y":18,"width":135,"height":135,"created":"2017-10-22 12:44:43","modified":"2017-10-22 12:44:43","timestamp":1518883054}],"Closet":{"id":21256,"user_id":102,"client_id":7040,"slug":"102H&S8bCX","show_closet":0,"show_lookbook":0,"show_uploads":1,"comments_disabled":0,"is_stickied":0,"sticky_date":null,"position":0,"has_password":0,"password":null,"title":null,"header_image":null,"description":null,"created":"2017-10-22 12:42:38","modified":"2017-10-22 12:42:38","ClosetSection":[{"id":45174,"closet_id":21256,"is_lookbook_section":0,"is_owned_section":0,"title":"First Section","position":0,"created":"2017-10-22 12:42:38","modified":"2017-10-22 12:42:38","ClosetSectionsItem":[]},{"id":45175,"closet_id":21256,"is_lookbook_section":0,"is_owned_section":1,"title":"Recent Uploads","position":0,"created":"2017-10-22 12:42:38","modified":"2017-10-22 12:42:38","ClosetSectionsItem":[]}],"NotificationEvent":[]},"hasMultiplePhotos":false}};
			var catalogDataSource = {"4652":{"Closet":{"id":4652,"user_id":102,"client_id":null,"slug":"102H&Spoug","show_closet":1,"show_lookbook":1,"show_uploads":0,"comments_disabled":1,"is_stickied":0,"sticky_date":null,"position":0,"has_password":0,"password":"","title":"Father's Day Roundup","header_image":null,"description":"For all of the fathers in your life, here are some recommendations.\r\n\r\nFor personal recommendations, contact me at consultant@gmail.com","created":"May 11, 2016","modified":"2017-09-07 01:51:18","created_date_formatted":20160511},"ClosetSection":[{"id":15656,"closet_id":4652,"is_lookbook_section":0,"is_owned_section":1,"title":"Recent Uploads","position":0,"created":"2016-05-11 09:38:00","modified":"2016-05-11 09:38:00","ClosetSectionsItem":[{"id":348913,"closet_sections_id":15656}],"Look":[]},{"id":15660,"closet_id":4652,"is_lookbook_section":1,"is_owned_section":0,"title":"4 ways to wear","position":0,"created":"2016-05-11 10:44:43","modified":"2016-05-11 10:44:43","ClosetSectionsItem":[],"Look":[{"id":19593,"closet_sections_id":15660},{"id":19594,"closet_sections_id":15660},{"id":19595,"closet_sections_id":15660},{"id":19596,"closet_sections_id":15660},{"id":55146,"closet_sections_id":15660}]},{"id":15657,"closet_id":4652,"is_lookbook_section":0,"is_owned_section":0,"title":"Dressing Up","position":1,"created":"2016-05-11 09:38:40","modified":"2016-05-11 10:44:55","ClosetSectionsItem":[{"id":147222,"closet_sections_id":15657},{"id":147223,"closet_sections_id":15657},{"id":147224,"closet_sections_id":15657},{"id":206844,"closet_sections_id":15657},{"id":268960,"closet_sections_id":15657},{"id":275231,"closet_sections_id":15657}],"Look":[]},{"id":15655,"closet_id":4652,"is_lookbook_section":0,"is_owned_section":0,"title":"Tools & Toys","position":2,"created":"2016-05-11 09:38:00","modified":"2016-05-11 10:44:55","ClosetSectionsItem":[{"id":147219,"closet_sections_id":15655},{"id":147220,"closet_sections_id":15655},{"id":294448,"closet_sections_id":15655}],"Look":[]}],"NotificationEvent":[],"hasHeaderImage":0,"hasDescription":1,"timestamp":1518883054},"3023":{"Closet":{"id":3023,"user_id":102,"client_id":null,"slug":"102H&Sr8sg","show_closet":0,"show_lookbook":1,"show_uploads":0,"comments_disabled":1,"is_stickied":0,"sticky_date":null,"position":0,"has_password":0,"password":"","title":"Jean Trends for Spring","header_image":null,"description":"Some trends we are seeing this spring are floral patterns, white denim, and raw-edge cuts.\r\n\r\nIf you are interested in purchasing any of these recommendations, simply click on the photo or view details to go to the retailer.\r\n\r\nFor personal recommendations, contact me at consultant@gmail.com\r\nOr visit my website: https:\/\/hueandstripe.com","created":"September 29, 2015","modified":"2018-01-12 21:53:23","shortDescription":"Some trends we are seeing this spring are floral patterns, white denim, and raw-edge cuts.\r\n\r\nIf you are interested in purchasing...","created_date_formatted":20150929},"ClosetSection":[{"id":5984,"closet_id":3023,"is_lookbook_section":0,"is_owned_section":1,"title":"Recent Uploads","position":0,"created":"2015-09-29 17:53:08","modified":"2015-09-29 17:53:08","ClosetSectionsItem":[],"Look":[]},{"id":6280,"closet_id":3023,"is_lookbook_section":1,"is_owned_section":0,"title":"Jean Looks","position":0,"created":"2015-10-07 13:43:25","modified":"2015-10-07 13:43:25","ClosetSectionsItem":[],"Look":[{"id":6259,"closet_sections_id":6280},{"id":90448,"closet_sections_id":6280}]},{"id":5983,"closet_id":3023,"is_lookbook_section":0,"is_owned_section":0,"title":"Examples","position":1,"created":"2015-09-29 17:53:08","modified":"2017-08-28 11:22:44","ClosetSectionsItem":[{"id":54468,"closet_sections_id":5983},{"id":54469,"closet_sections_id":5983},{"id":365081,"closet_sections_id":5983},{"id":365085,"closet_sections_id":5983},{"id":365090,"closet_sections_id":5983}],"Look":[]}],"NotificationEvent":[],"hasHeaderImage":0,"hasDescription":1,"timestamp":1518883054},"1790":{"Closet":{"id":1790,"user_id":102,"client_id":null,"slug":"102H&S51FP","show_closet":1,"show_lookbook":1,"show_uploads":1,"comments_disabled":1,"is_stickied":0,"sticky_date":null,"position":0,"has_password":0,"password":"","title":"Your New Online Closet","header_image":null,"description":"Welcome to your new online wardrobe. Here everything is broken down into 3 sections:\r\n\r\nFinds - Items your stylist (me!) finds for you from any retailer\r\nLookbook - Outfits I put together for you or photograph you in\r\nCloset - Individual items you own. Upload them here so I can use them in the Lookbook.\r\n\r\nAny time you need personal advice, feel free to reach me at Craig@HueAndStripe.com\r\nGet started with me one on one by filling out this form: https:\/\/hueandstripe.com\/c\/PX8ENKkQ\r\n\r\nYou can even add this to your smartphone - see instructions in the Closet FAQ at the bottom of the page.","created":"February 12, 2015","modified":"2018-02-01 11:09:08","shortDescription":"Welcome to your new online wardrobe. Here everything is broken down into 3 sections:\r\n\r\nFinds - Items your stylist (me!) finds...","created_date_formatted":20150212},"ClosetSection":[{"id":805,"closet_id":1790,"is_lookbook_section":0,"is_owned_section":1,"title":"My Closet: Items I Own","position":0,"created":"2015-02-12 12:52:59","modified":"2015-02-12 12:52:59","ClosetSectionsItem":[{"id":7805,"closet_sections_id":805},{"id":10557,"closet_sections_id":805},{"id":21222,"closet_sections_id":805},{"id":21224,"closet_sections_id":805},{"id":21225,"closet_sections_id":805}],"Look":[]},{"id":51307,"closet_id":1790,"is_lookbook_section":0,"is_owned_section":0,"title":"Investment Pieces","position":1,"created":"2018-01-31 15:42:19","modified":"2018-01-31 15:42:20","ClosetSectionsItem":[{"id":507938,"closet_sections_id":51307},{"id":507952,"closet_sections_id":51307},{"id":507954,"closet_sections_id":51307},{"id":507955,"closet_sections_id":51307},{"id":507957,"closet_sections_id":51307},{"id":507958,"closet_sections_id":51307},{"id":507959,"closet_sections_id":51307}],"Look":[]},{"id":1151,"closet_id":1790,"is_lookbook_section":1,"is_owned_section":0,"title":"Dressing Up","position":1,"created":"2015-03-16 11:57:36","modified":"2018-01-31 16:08:44","ClosetSectionsItem":[],"Look":[{"id":618,"closet_sections_id":1151},{"id":93622,"closet_sections_id":1151},{"id":93623,"closet_sections_id":1151}]},{"id":33419,"closet_id":1790,"is_lookbook_section":1,"is_owned_section":0,"title":"Week of May 8th","position":2,"created":"2017-05-02 15:19:33","modified":"2018-01-31 16:08:44","ClosetSectionsItem":[],"Look":[{"id":49485,"closet_sections_id":33419},{"id":49500,"closet_sections_id":33419},{"id":73265,"closet_sections_id":33419},{"id":78245,"closet_sections_id":33419},{"id":87965,"closet_sections_id":33419}]},{"id":3804,"closet_id":1790,"is_lookbook_section":0,"is_owned_section":0,"title":"Inspiration","position":2,"created":"2015-08-06 16:58:55","modified":"2018-01-31 15:42:20","ClosetSectionsItem":[{"id":37900,"closet_sections_id":3804},{"id":37905,"closet_sections_id":3804},{"id":37910,"closet_sections_id":3804},{"id":248488,"closet_sections_id":3804},{"id":286724,"closet_sections_id":3804},{"id":287026,"closet_sections_id":3804},{"id":357253,"closet_sections_id":3804},{"id":400437,"closet_sections_id":3804},{"id":474064,"closet_sections_id":3804}],"Look":[]},{"id":803,"closet_id":1790,"is_lookbook_section":0,"is_owned_section":0,"title":"Wardrobe Update","position":3,"created":"2015-02-12 12:31:18","modified":"2018-01-31 15:42:20","ClosetSectionsItem":[{"id":10555,"closet_sections_id":803},{"id":10558,"closet_sections_id":803},{"id":10561,"closet_sections_id":803},{"id":10562,"closet_sections_id":803},{"id":10563,"closet_sections_id":803},{"id":10564,"closet_sections_id":803},{"id":10565,"closet_sections_id":803},{"id":10566,"closet_sections_id":803},{"id":102305,"closet_sections_id":803},{"id":106241,"closet_sections_id":803},{"id":115500,"closet_sections_id":803},{"id":295671,"closet_sections_id":803},{"id":386218,"closet_sections_id":803},{"id":400438,"closet_sections_id":803},{"id":439397,"closet_sections_id":803},{"id":446994,"closet_sections_id":803},{"id":478391,"closet_sections_id":803},{"id":496280,"closet_sections_id":803}],"Look":[]},{"id":804,"closet_id":1790,"is_lookbook_section":1,"is_owned_section":0,"title":"Casual Looks","position":3,"created":"2015-02-12 12:31:31","modified":"2018-01-31 16:08:44","ClosetSectionsItem":[],"Look":[{"id":385,"closet_sections_id":804},{"id":386,"closet_sections_id":804},{"id":615,"closet_sections_id":804},{"id":15428,"closet_sections_id":804},{"id":15430,"closet_sections_id":804},{"id":15431,"closet_sections_id":804}]},{"id":1150,"closet_id":1790,"is_lookbook_section":1,"is_owned_section":0,"title":"Day At the Park","position":4,"created":"2015-03-16 11:49:11","modified":"2018-01-31 16:08:44","ClosetSectionsItem":[],"Look":[{"id":616,"closet_sections_id":1150},{"id":617,"closet_sections_id":1150},{"id":1626,"closet_sections_id":1150}]}],"NotificationEvent":[],"hasHeaderImage":0,"hasDescription":1,"timestamp":1518883054},"1561":{"Closet":{"id":1561,"user_id":102,"client_id":null,"slug":"102H&SLeDQ","show_closet":1,"show_lookbook":1,"show_uploads":0,"comments_disabled":1,"is_stickied":0,"sticky_date":null,"position":4,"has_password":0,"password":"pass2","title":"Business Casual Roundup (Women)","header_image":null,"description":"This roundup should serve as a springboard and inspiration in your personal shopping.  These items are purchasable, but there is much more available to you if you remember the principles we talked about.  Here is a re-cap from our consultation:\r\n\r\n1.  Remember that skirts and dresses are acceptable as long as the hem falls just above the knees.\r\n2.  As with men, black and grey are more formal, making for a safer bet.\r\n3.  Avoid low-cut dresses or those with high slits.\r\n4.  Avoid dresses (especially) and skirts that are more form-fitting.\r\n5.  No sundresses.\r\n\r\nIf you find you want more personal help, let's find a time to work something out.  Feel free to email me at consultant@gmail.com.","created":"November 2, 2014","modified":"2018-01-08 04:42:03","shortDescription":"This roundup should serve as a springboard and inspiration in your personal shopping.  These items are purchasable, but there...","created_date_formatted":20141102},"ClosetSection":[{"id":639,"closet_id":1561,"is_lookbook_section":1,"is_owned_section":0,"title":"Business Looks","position":1,"created":"2015-01-27 10:09:03","modified":"2015-03-09 12:25:23","ClosetSectionsItem":[],"Look":[{"id":206,"closet_sections_id":639},{"id":518,"closet_sections_id":639},{"id":521,"closet_sections_id":639},{"id":1539,"closet_sections_id":639},{"id":29621,"closet_sections_id":639},{"id":29622,"closet_sections_id":639}]},{"id":156,"closet_id":1561,"is_lookbook_section":0,"is_owned_section":0,"title":"Skirts","position":1,"created":"2014-11-02 01:52:31","modified":"2017-05-01 09:56:07","ClosetSectionsItem":[{"id":1068,"closet_sections_id":156},{"id":1070,"closet_sections_id":156},{"id":1071,"closet_sections_id":156},{"id":1072,"closet_sections_id":156}],"Look":[]},{"id":1763,"closet_id":1561,"is_lookbook_section":0,"is_owned_section":0,"title":"Business casual","position":2,"created":"2015-04-20 11:00:17","modified":"2017-05-01 09:56:07","ClosetSectionsItem":[{"id":17517,"closet_sections_id":1763},{"id":17518,"closet_sections_id":1763},{"id":28672,"closet_sections_id":1763},{"id":45260,"closet_sections_id":1763},{"id":278287,"closet_sections_id":1763},{"id":298192,"closet_sections_id":1763},{"id":322778,"closet_sections_id":1763},{"id":322780,"closet_sections_id":1763},{"id":491244,"closet_sections_id":1763}],"Look":[]},{"id":155,"closet_id":1561,"is_lookbook_section":0,"is_owned_section":0,"title":"Tops & Blouses","position":3,"created":"2014-11-02 01:30:18","modified":"2017-05-01 09:56:07","ClosetSectionsItem":[{"id":1061,"closet_sections_id":155},{"id":1062,"closet_sections_id":155},{"id":1063,"closet_sections_id":155},{"id":1064,"closet_sections_id":155},{"id":1065,"closet_sections_id":155},{"id":1066,"closet_sections_id":155},{"id":1067,"closet_sections_id":155},{"id":1069,"closet_sections_id":155},{"id":4536,"closet_sections_id":155},{"id":4879,"closet_sections_id":155},{"id":10643,"closet_sections_id":155},{"id":10652,"closet_sections_id":155},{"id":38952,"closet_sections_id":155},{"id":63894,"closet_sections_id":155}],"Look":[]}],"NotificationEvent":[],"hasHeaderImage":0,"hasDescription":1,"timestamp":1518883054},"1560":{"Closet":{"id":1560,"user_id":102,"client_id":null,"slug":"102H&SwKTi","show_closet":1,"show_lookbook":1,"show_uploads":0,"comments_disabled":1,"is_stickied":0,"sticky_date":null,"position":4,"has_password":0,"password":"","title":"Fall Catalog","header_image":null,"description":"Contact me for personal recommendations","created":"November 2, 2014","modified":"2018-01-01 11:18:52","created_date_formatted":20141102},"ClosetSection":[{"id":11010,"closet_id":1560,"is_lookbook_section":1,"is_owned_section":0,"title":"Looks","position":0,"created":"2016-02-10 20:43:44","modified":"2016-02-10 20:43:44","ClosetSectionsItem":[],"Look":[]},{"id":5289,"closet_id":1560,"is_lookbook_section":0,"is_owned_section":0,"title":"boots","position":1,"created":"2015-09-11 13:23:20","modified":"2016-02-10 20:43:48","ClosetSectionsItem":[{"id":258555,"closet_sections_id":5289},{"id":478389,"closet_sections_id":5289},{"id":487661,"closet_sections_id":5289}],"Look":[]},{"id":5285,"closet_id":1560,"is_lookbook_section":0,"is_owned_section":0,"title":"tweed","position":2,"created":"2015-09-11 12:46:16","modified":"2016-02-10 20:43:48","ClosetSectionsItem":[{"id":47766,"closet_sections_id":5285},{"id":182340,"closet_sections_id":5285},{"id":324224,"closet_sections_id":5285}],"Look":[]}],"NotificationEvent":[],"hasHeaderImage":0,"hasDescription":1,"timestamp":1518883054}};
			var closetCounts = {"102H&S51FP":41,"102H&SBqMi":14,"102H&SCoDy":34,"102H&SigHq":39,"102H&SIuyJ":8,"102H&SktIk":41,"102H&SL3oh":75,"102H&SLeDQ":28,"102H&Spoug":11,"102H&Sr8sg":7,"102H&SU1NU":171,"102H&SwKTi":7,"102H&SWVxc":170};
			var invoiceDataSource = {"787":{"Invoice":{"id":787,"user_id":102,"client_id":1583,"is_order":0,"slug":"DEF5664A-2CCD-4825-81CA-A5DBA34617A4","client_name":"Emma Rock","client_address":", <br>Scottsdale, AZ  <br>clientemail@gmail.com","email":"clientemail@gmail.com","notes":"pay me!!","total":100,"due_date":"April 4, 2017","status":"Void","paid_date":null,"last_four":null,"card_brand":null,"stripe_invoice_id":null,"created":"March 28, 2017","modified":"2017-03-28 13:21:17","manually_marked_paid":0,"created_date_formatted":1490728836,"due_date_formatted":1491285600,"timestamp":1518883056},"User":{"id":102,"account_type":0,"first_name":"Consultant","last_name":"Example","email":"youremail@consultant.com","username":"Demo","password":"$2a$10$meZ3MznWbyA9sNnU8z9y.OlDnQrKxAXHmKXQ7ittB5m0vLbwSNbFC","role":0,"use_custom_branding":1,"company_name":"Your Image Company","company_url":"yourimagecompany.com","pricing_plan_id":1,"active_months":null,"access_code":null,"trial_end_date":null,"current_until_date":null,"payment_period_start_date":null,"card_last_4":1234,"billing_name":"Your Name","card_exp_month":5,"card_exp_year":2019,"menswear_enabled":0,"stripe_token":"cus_4nkdKICI0eQFca","statement_descriptor":"Image Company","connect_access_token":"sk_live_FGq5kvnjHD5bLccLb96OQKFS","connect_refresh_token":"rt_6vne4Cdl8DN1GkttYbdRO0cAuG5M6BXAL3TTW1FxM2ITpYG9","connect_publishable_key":"pk_live_AkmblvyPIy9vunmBVE5cRCoN","connect_user_id":"acct_16hvkGKtN1DilZXw","created":"2014-09-18 11:54:21","modified":"2017-10-19 11:03:25"},"Client":[{"id":1583,"user_id":102,"unique_code":"102H&SWVxc","intake_form_id":null,"email":"clientemail@gmail.com","first_name":"Emma","last_name":"Rock","birthday":"","anniversary":"","follow_up_date":"2018-03-22 00:00:00","height":"5'5","age":27,"sex":"female","phone":"(123) 456-7890","shoe_size":"","pant_inseam":"","bust":"","waist":"","hips":"","descriptive_words":"","body_shape":0,"face_shape":0,"street_address":"","city":"Scottsdale","state":"AZ","zipcode":"","country":"USA","notes":"Do a wardrobe refresh this spring\n\nHelped her prepare for her promotional tour\n\n","stripe_cust_id":null,"platform_stripe_cust_id":null,"created":"2014-11-07 13:21:59","modified":"2018-02-16 11:37:52","full_name":"Emma Rock","ClientsPhoto":[{"id":1762,"client_id":1583,"filename":"1583_587e87cc32364.jpg","is_primary":1,"x":0,"y":0,"width":980,"height":980,"created":"2017-01-17 14:08:28","modified":"2017-01-17 14:08:28","timestamp":1518883056}],"hasMultiplePhotos":false}]},"786":{"Invoice":{"id":786,"user_id":102,"client_id":1583,"is_order":0,"slug":"9FBC85B2-C33C-4FEC-822A-F7CDF808828B","client_name":"Emma Rock","client_address":", <br>Scottsdale, AZ  <br>clientemail@gmail.com","email":"clientemail@gmail.com","notes":"","total":20,"due_date":"April 4, 2017","status":"Paid","paid_date":"2017-06-14 08:07:35","last_four":null,"card_brand":null,"stripe_invoice_id":null,"created":"March 28, 2017","modified":"2017-06-14 08:07:35","manually_marked_paid":1,"created_date_formatted":1490728835,"due_date_formatted":1491285600,"timestamp":1518883056},"User":{"id":102,"account_type":0,"first_name":"Consultant","last_name":"Example","email":"youremail@consultant.com","username":"Demo","password":"$2a$10$meZ3MznWbyA9sNnU8z9y.OlDnQrKxAXHmKXQ7ittB5m0vLbwSNbFC","role":0,"use_custom_branding":1,"company_name":"Your Image Company","company_url":"yourimagecompany.com","pricing_plan_id":1,"active_months":null,"access_code":null,"trial_end_date":null,"current_until_date":null,"payment_period_start_date":null,"card_last_4":1234,"billing_name":"Your Name","card_exp_month":5,"card_exp_year":2019,"menswear_enabled":0,"stripe_token":"cus_4nkdKICI0eQFca","statement_descriptor":"Image Company","connect_access_token":"sk_live_FGq5kvnjHD5bLccLb96OQKFS","connect_refresh_token":"rt_6vne4Cdl8DN1GkttYbdRO0cAuG5M6BXAL3TTW1FxM2ITpYG9","connect_publishable_key":"pk_live_AkmblvyPIy9vunmBVE5cRCoN","connect_user_id":"acct_16hvkGKtN1DilZXw","created":"2014-09-18 11:54:21","modified":"2017-10-19 11:03:25"},"Client":[{"id":1583,"user_id":102,"unique_code":"102H&SWVxc","intake_form_id":null,"email":"clientemail@gmail.com","first_name":"Emma","last_name":"Rock","birthday":"","anniversary":"","follow_up_date":"2018-03-22 00:00:00","height":"5'5","age":27,"sex":"female","phone":"(123) 456-7890","shoe_size":"","pant_inseam":"","bust":"","waist":"","hips":"","descriptive_words":"","body_shape":0,"face_shape":0,"street_address":"","city":"Scottsdale","state":"AZ","zipcode":"","country":"USA","notes":"Do a wardrobe refresh this spring\n\nHelped her prepare for her promotional tour\n\n","stripe_cust_id":null,"platform_stripe_cust_id":null,"created":"2014-11-07 13:21:59","modified":"2018-02-16 11:37:52","full_name":"Emma Rock","ClientsPhoto":[{"id":1762,"client_id":1583,"filename":"1583_587e87cc32364.jpg","is_primary":1,"x":0,"y":0,"width":980,"height":980,"created":"2017-01-17 14:08:28","modified":"2017-01-17 14:08:28","timestamp":1518883056}],"hasMultiplePhotos":false}]},"487":{"Invoice":{"id":487,"user_id":102,"client_id":1583,"is_order":0,"slug":"CBAF8C7F-8BC1-4623-99B2-4B0243BF848A","client_name":"Emma Rock","client_address":", <br>Scottsdale, AZ  <br>clientemail@gmail.com","email":"clientemail@gmail.com","notes":"","total":300,"due_date":"November 18, 2016","status":"Outstanding","paid_date":null,"last_four":null,"card_brand":null,"stripe_invoice_id":null,"created":"November 11, 2016","modified":"2016-11-11 12:36:48","manually_marked_paid":0,"created_date_formatted":1478893008,"due_date_formatted":1479452400,"timestamp":1518883056},"User":{"id":102,"account_type":0,"first_name":"Consultant","last_name":"Example","email":"youremail@consultant.com","username":"Demo","password":"$2a$10$meZ3MznWbyA9sNnU8z9y.OlDnQrKxAXHmKXQ7ittB5m0vLbwSNbFC","role":0,"use_custom_branding":1,"company_name":"Your Image Company","company_url":"yourimagecompany.com","pricing_plan_id":1,"active_months":null,"access_code":null,"trial_end_date":null,"current_until_date":null,"payment_period_start_date":null,"card_last_4":1234,"billing_name":"Your Name","card_exp_month":5,"card_exp_year":2019,"menswear_enabled":0,"stripe_token":"cus_4nkdKICI0eQFca","statement_descriptor":"Image Company","connect_access_token":"sk_live_FGq5kvnjHD5bLccLb96OQKFS","connect_refresh_token":"rt_6vne4Cdl8DN1GkttYbdRO0cAuG5M6BXAL3TTW1FxM2ITpYG9","connect_publishable_key":"pk_live_AkmblvyPIy9vunmBVE5cRCoN","connect_user_id":"acct_16hvkGKtN1DilZXw","created":"2014-09-18 11:54:21","modified":"2017-10-19 11:03:25"},"Client":[{"id":1583,"user_id":102,"unique_code":"102H&SWVxc","intake_form_id":null,"email":"clientemail@gmail.com","first_name":"Emma","last_name":"Rock","birthday":"","anniversary":"","follow_up_date":"2018-03-22 00:00:00","height":"5'5","age":27,"sex":"female","phone":"(123) 456-7890","shoe_size":"","pant_inseam":"","bust":"","waist":"","hips":"","descriptive_words":"","body_shape":0,"face_shape":0,"street_address":"","city":"Scottsdale","state":"AZ","zipcode":"","country":"USA","notes":"Do a wardrobe refresh this spring\n\nHelped her prepare for her promotional tour\n\n","stripe_cust_id":null,"platform_stripe_cust_id":null,"created":"2014-11-07 13:21:59","modified":"2018-02-16 11:37:52","full_name":"Emma Rock","ClientsPhoto":[{"id":1762,"client_id":1583,"filename":"1583_587e87cc32364.jpg","is_primary":1,"x":0,"y":0,"width":980,"height":980,"created":"2017-01-17 14:08:28","modified":"2017-01-17 14:08:28","timestamp":1518883056}],"hasMultiplePhotos":false}]},"382":{"Invoice":{"id":382,"user_id":102,"client_id":1583,"is_order":0,"slug":"9087C420-3B6C-4C5C-90D7-FBB862AD86BE","client_name":"Emma Rock","client_address":", <br>Scottsdale, AZ  <br>clientemail@gmail.com","email":"clientemail@gmail.com","notes":"Purchases from Nordstrom during the Annual Sale","total":342,"due_date":"September 29, 2016","status":"Outstanding","paid_date":null,"last_four":null,"card_brand":null,"stripe_invoice_id":null,"created":"September 22, 2016","modified":"2016-09-22 10:33:47","manually_marked_paid":0,"created_date_formatted":1474562027,"due_date_formatted":1475128800,"timestamp":1518883056},"User":{"id":102,"account_type":0,"first_name":"Consultant","last_name":"Example","email":"youremail@consultant.com","username":"Demo","password":"$2a$10$meZ3MznWbyA9sNnU8z9y.OlDnQrKxAXHmKXQ7ittB5m0vLbwSNbFC","role":0,"use_custom_branding":1,"company_name":"Your Image Company","company_url":"yourimagecompany.com","pricing_plan_id":1,"active_months":null,"access_code":null,"trial_end_date":null,"current_until_date":null,"payment_period_start_date":null,"card_last_4":1234,"billing_name":"Your Name","card_exp_month":5,"card_exp_year":2019,"menswear_enabled":0,"stripe_token":"cus_4nkdKICI0eQFca","statement_descriptor":"Image Company","connect_access_token":"sk_live_FGq5kvnjHD5bLccLb96OQKFS","connect_refresh_token":"rt_6vne4Cdl8DN1GkttYbdRO0cAuG5M6BXAL3TTW1FxM2ITpYG9","connect_publishable_key":"pk_live_AkmblvyPIy9vunmBVE5cRCoN","connect_user_id":"acct_16hvkGKtN1DilZXw","created":"2014-09-18 11:54:21","modified":"2017-10-19 11:03:25"},"Client":[{"id":1583,"user_id":102,"unique_code":"102H&SWVxc","intake_form_id":null,"email":"clientemail@gmail.com","first_name":"Emma","last_name":"Rock","birthday":"","anniversary":"","follow_up_date":"2018-03-22 00:00:00","height":"5'5","age":27,"sex":"female","phone":"(123) 456-7890","shoe_size":"","pant_inseam":"","bust":"","waist":"","hips":"","descriptive_words":"","body_shape":0,"face_shape":0,"street_address":"","city":"Scottsdale","state":"AZ","zipcode":"","country":"USA","notes":"Do a wardrobe refresh this spring\n\nHelped her prepare for her promotional tour\n\n","stripe_cust_id":null,"platform_stripe_cust_id":null,"created":"2014-11-07 13:21:59","modified":"2018-02-16 11:37:52","full_name":"Emma Rock","ClientsPhoto":[{"id":1762,"client_id":1583,"filename":"1583_587e87cc32364.jpg","is_primary":1,"x":0,"y":0,"width":980,"height":980,"created":"2017-01-17 14:08:28","modified":"2017-01-17 14:08:28","timestamp":1518883056}],"hasMultiplePhotos":false}]},"260":{"Invoice":{"id":260,"user_id":102,"client_id":1517,"is_order":0,"slug":"939BD065-049E-408D-A079-E5C9CB2C7B2C","client_name":"Alice Smith","client_address":", <br>Oakland, CA  <br>test@gmail.com","email":"test@gmail.com","notes":"","total":300,"due_date":"June 21, 2016","status":"Paid","paid_date":"2016-07-07 01:34:57","last_four":null,"card_brand":null,"stripe_invoice_id":null,"created":"June 14, 2016","modified":"2016-07-07 13:34:57","manually_marked_paid":1,"created_date_formatted":1465920719,"due_date_formatted":1466488800,"timestamp":1518883056},"User":{"id":102,"account_type":0,"first_name":"Consultant","last_name":"Example","email":"youremail@consultant.com","username":"Demo","password":"$2a$10$meZ3MznWbyA9sNnU8z9y.OlDnQrKxAXHmKXQ7ittB5m0vLbwSNbFC","role":0,"use_custom_branding":1,"company_name":"Your Image Company","company_url":"yourimagecompany.com","pricing_plan_id":1,"active_months":null,"access_code":null,"trial_end_date":null,"current_until_date":null,"payment_period_start_date":null,"card_last_4":1234,"billing_name":"Your Name","card_exp_month":5,"card_exp_year":2019,"menswear_enabled":0,"stripe_token":"cus_4nkdKICI0eQFca","statement_descriptor":"Image Company","connect_access_token":"sk_live_FGq5kvnjHD5bLccLb96OQKFS","connect_refresh_token":"rt_6vne4Cdl8DN1GkttYbdRO0cAuG5M6BXAL3TTW1FxM2ITpYG9","connect_publishable_key":"pk_live_AkmblvyPIy9vunmBVE5cRCoN","connect_user_id":"acct_16hvkGKtN1DilZXw","created":"2014-09-18 11:54:21","modified":"2017-10-19 11:03:25"},"Client":[{"id":1517,"user_id":102,"unique_code":"102H&SU1NU","intake_form_id":null,"email":"test@gmail.com","first_name":"Alice","last_name":"Smith","birthday":"","anniversary":"","follow_up_date":"2016-04-13 00:00:00","height":"","age":"","sex":"female","phone":"","shoe_size":"","pant_inseam":"","bust":"","waist":"","hips":"","descriptive_words":"","body_shape":0,"face_shape":0,"street_address":"","city":"Oakland","state":"CA","zipcode":"","country":"USA","notes":null,"stripe_cust_id":"cus_6z7mIuqTPBQ5M2","platform_stripe_cust_id":null,"created":"2014-09-20 15:17:42","modified":"2018-01-13 02:47:48","full_name":"Alice Smith","ClientsPhoto":[{"id":100,"client_id":1517,"filename":"1517_554bae9da81ed.jpg","is_primary":1,"x":277,"y":65,"width":379,"height":379,"created":"2015-05-07 12:27:41","modified":"2015-05-12 18:51:56","timestamp":1518883056}],"hasMultiplePhotos":false}]},"209":{"Invoice":{"id":209,"user_id":102,"client_id":3838,"is_order":0,"slug":"4F10FBE7-C831-4876-A969-B6663B10F2FD","client_name":"Joe Shmo","client_address":", <br>youngstown, AL  <br>joshmo@gmail.com","email":"joshmo@gmail.com","notes":"Thank you! See you in September!","total":400,"due_date":"May 2, 2016","status":"Outstanding","paid_date":null,"last_four":null,"card_brand":null,"stripe_invoice_id":null,"created":"April 25, 2016","modified":"2016-04-25 16:30:01","manually_marked_paid":0,"created_date_formatted":1461623401,"due_date_formatted":1462168800,"timestamp":1518883056},"User":{"id":102,"account_type":0,"first_name":"Consultant","last_name":"Example","email":"youremail@consultant.com","username":"Demo","password":"$2a$10$meZ3MznWbyA9sNnU8z9y.OlDnQrKxAXHmKXQ7ittB5m0vLbwSNbFC","role":0,"use_custom_branding":1,"company_name":"Your Image Company","company_url":"yourimagecompany.com","pricing_plan_id":1,"active_months":null,"access_code":null,"trial_end_date":null,"current_until_date":null,"payment_period_start_date":null,"card_last_4":1234,"billing_name":"Your Name","card_exp_month":5,"card_exp_year":2019,"menswear_enabled":0,"stripe_token":"cus_4nkdKICI0eQFca","statement_descriptor":"Image Company","connect_access_token":"sk_live_FGq5kvnjHD5bLccLb96OQKFS","connect_refresh_token":"rt_6vne4Cdl8DN1GkttYbdRO0cAuG5M6BXAL3TTW1FxM2ITpYG9","connect_publishable_key":"pk_live_AkmblvyPIy9vunmBVE5cRCoN","connect_user_id":"acct_16hvkGKtN1DilZXw","created":"2014-09-18 11:54:21","modified":"2017-10-19 11:03:25"},"Client":[{"id":3838,"user_id":102,"unique_code":"102H&SCoDy","intake_form_id":null,"email":"joshmo@gmail.com","first_name":"Joe","last_name":"Shmo","birthday":"","anniversary":"","follow_up_date":"2016-04-29 00:00:00","height":"","age":"","sex":"","phone":"","shoe_size":6,"pant_inseam":50,"bust":34,"waist":32,"hips":33,"descriptive_words":"","body_shape":0,"face_shape":0,"street_address":"","city":"youngstown","state":"AL","zipcode":"","country":"USA","notes":null,"stripe_cust_id":null,"platform_stripe_cust_id":null,"created":"2016-04-25 16:28:29","modified":"2017-12-21 03:05:55","full_name":"Joe Shmo","ClientsPhoto":[],"hasMultiplePhotos":false}]},"203":{"Invoice":{"id":203,"user_id":102,"client_id":1583,"is_order":0,"slug":"02E88C55-29E5-4C29-95F8-1A41DE52B440","client_name":"Emma Rock","client_address":", <br>Scottsdale, AZ  <br>test3@gmail.com","email":"test3@gmail.com","notes":"","total":180,"due_date":"April 26, 2016","status":"Paid","paid_date":"2016-07-07 01:35:56","last_four":null,"card_brand":null,"stripe_invoice_id":null,"created":"April 19, 2016","modified":"2016-07-07 13:35:56","manually_marked_paid":1,"created_date_formatted":1461086269,"due_date_formatted":1461650400,"timestamp":1518883056},"User":{"id":102,"account_type":0,"first_name":"Consultant","last_name":"Example","email":"youremail@consultant.com","username":"Demo","password":"$2a$10$meZ3MznWbyA9sNnU8z9y.OlDnQrKxAXHmKXQ7ittB5m0vLbwSNbFC","role":0,"use_custom_branding":1,"company_name":"Your Image Company","company_url":"yourimagecompany.com","pricing_plan_id":1,"active_months":null,"access_code":null,"trial_end_date":null,"current_until_date":null,"payment_period_start_date":null,"card_last_4":1234,"billing_name":"Your Name","card_exp_month":5,"card_exp_year":2019,"menswear_enabled":0,"stripe_token":"cus_4nkdKICI0eQFca","statement_descriptor":"Image Company","connect_access_token":"sk_live_FGq5kvnjHD5bLccLb96OQKFS","connect_refresh_token":"rt_6vne4Cdl8DN1GkttYbdRO0cAuG5M6BXAL3TTW1FxM2ITpYG9","connect_publishable_key":"pk_live_AkmblvyPIy9vunmBVE5cRCoN","connect_user_id":"acct_16hvkGKtN1DilZXw","created":"2014-09-18 11:54:21","modified":"2017-10-19 11:03:25"},"Client":[{"id":1583,"user_id":102,"unique_code":"102H&SWVxc","intake_form_id":null,"email":"clientemail@gmail.com","first_name":"Emma","last_name":"Rock","birthday":"","anniversary":"","follow_up_date":"2018-03-22 00:00:00","height":"5'5","age":27,"sex":"female","phone":"(123) 456-7890","shoe_size":"","pant_inseam":"","bust":"","waist":"","hips":"","descriptive_words":"","body_shape":0,"face_shape":0,"street_address":"","city":"Scottsdale","state":"AZ","zipcode":"","country":"USA","notes":"Do a wardrobe refresh this spring\n\nHelped her prepare for her promotional tour\n\n","stripe_cust_id":null,"platform_stripe_cust_id":null,"created":"2014-11-07 13:21:59","modified":"2018-02-16 11:37:52","full_name":"Emma Rock","ClientsPhoto":[{"id":1762,"client_id":1583,"filename":"1583_587e87cc32364.jpg","is_primary":1,"x":0,"y":0,"width":980,"height":980,"created":"2017-01-17 14:08:28","modified":"2017-01-17 14:08:28","timestamp":1518883056}],"hasMultiplePhotos":false}]},"198":{"Invoice":{"id":198,"user_id":102,"client_id":1583,"is_order":0,"slug":"DD6BDE90-7023-4294-9BF8-2AB113694E6B","client_name":"Emma Rock","client_address":", <br>Scottsdale, AZ  <br>test3@gmail.com","email":"test3@gmail.com","notes":"Thank you ","total":324,"due_date":"April 13, 2016","status":"Paid","paid_date":"2016-07-13 10:09:24","last_four":null,"card_brand":null,"stripe_invoice_id":null,"created":"April 13, 2016","modified":"2016-07-13 10:09:24","manually_marked_paid":1,"created_date_formatted":1460564399,"due_date_formatted":1460527200,"timestamp":1518883056},"User":{"id":102,"account_type":0,"first_name":"Consultant","last_name":"Example","email":"youremail@consultant.com","username":"Demo","password":"$2a$10$meZ3MznWbyA9sNnU8z9y.OlDnQrKxAXHmKXQ7ittB5m0vLbwSNbFC","role":0,"use_custom_branding":1,"company_name":"Your Image Company","company_url":"yourimagecompany.com","pricing_plan_id":1,"active_months":null,"access_code":null,"trial_end_date":null,"current_until_date":null,"payment_period_start_date":null,"card_last_4":1234,"billing_name":"Your Name","card_exp_month":5,"card_exp_year":2019,"menswear_enabled":0,"stripe_token":"cus_4nkdKICI0eQFca","statement_descriptor":"Image Company","connect_access_token":"sk_live_FGq5kvnjHD5bLccLb96OQKFS","connect_refresh_token":"rt_6vne4Cdl8DN1GkttYbdRO0cAuG5M6BXAL3TTW1FxM2ITpYG9","connect_publishable_key":"pk_live_AkmblvyPIy9vunmBVE5cRCoN","connect_user_id":"acct_16hvkGKtN1DilZXw","created":"2014-09-18 11:54:21","modified":"2017-10-19 11:03:25"},"Client":[{"id":1583,"user_id":102,"unique_code":"102H&SWVxc","intake_form_id":null,"email":"clientemail@gmail.com","first_name":"Emma","last_name":"Rock","birthday":"","anniversary":"","follow_up_date":"2018-03-22 00:00:00","height":"5'5","age":27,"sex":"female","phone":"(123) 456-7890","shoe_size":"","pant_inseam":"","bust":"","waist":"","hips":"","descriptive_words":"","body_shape":0,"face_shape":0,"street_address":"","city":"Scottsdale","state":"AZ","zipcode":"","country":"USA","notes":"Do a wardrobe refresh this spring\n\nHelped her prepare for her promotional tour\n\n","stripe_cust_id":null,"platform_stripe_cust_id":null,"created":"2014-11-07 13:21:59","modified":"2018-02-16 11:37:52","full_name":"Emma Rock","ClientsPhoto":[{"id":1762,"client_id":1583,"filename":"1583_587e87cc32364.jpg","is_primary":1,"x":0,"y":0,"width":980,"height":980,"created":"2017-01-17 14:08:28","modified":"2017-01-17 14:08:28","timestamp":1518883056}],"hasMultiplePhotos":false}]},"168":{"Invoice":{"id":168,"user_id":102,"client_id":1517,"is_order":0,"slug":"AA9FC3F8-F40C-4152-9F3B-DBF567E6A8A0","client_name":"Alice Smith","client_address":", <br>Oakland, CA  <br>test@gmail.com","email":"test@gmail.com","notes":"","total":540,"due_date":"March 5, 2016","status":"Void","paid_date":null,"last_four":null,"card_brand":null,"stripe_invoice_id":null,"created":"February 27, 2016","modified":"2016-03-17 19:09:59","manually_marked_paid":0,"created_date_formatted":1456618340,"due_date_formatted":1457161200,"timestamp":1518883056},"User":{"id":102,"account_type":0,"first_name":"Consultant","last_name":"Example","email":"youremail@consultant.com","username":"Demo","password":"$2a$10$meZ3MznWbyA9sNnU8z9y.OlDnQrKxAXHmKXQ7ittB5m0vLbwSNbFC","role":0,"use_custom_branding":1,"company_name":"Your Image Company","company_url":"yourimagecompany.com","pricing_plan_id":1,"active_months":null,"access_code":null,"trial_end_date":null,"current_until_date":null,"payment_period_start_date":null,"card_last_4":1234,"billing_name":"Your Name","card_exp_month":5,"card_exp_year":2019,"menswear_enabled":0,"stripe_token":"cus_4nkdKICI0eQFca","statement_descriptor":"Image Company","connect_access_token":"sk_live_FGq5kvnjHD5bLccLb96OQKFS","connect_refresh_token":"rt_6vne4Cdl8DN1GkttYbdRO0cAuG5M6BXAL3TTW1FxM2ITpYG9","connect_publishable_key":"pk_live_AkmblvyPIy9vunmBVE5cRCoN","connect_user_id":"acct_16hvkGKtN1DilZXw","created":"2014-09-18 11:54:21","modified":"2017-10-19 11:03:25"},"Client":[{"id":1517,"user_id":102,"unique_code":"102H&SU1NU","intake_form_id":null,"email":"test@gmail.com","first_name":"Alice","last_name":"Smith","birthday":"","anniversary":"","follow_up_date":"2016-04-13 00:00:00","height":"","age":"","sex":"female","phone":"","shoe_size":"","pant_inseam":"","bust":"","waist":"","hips":"","descriptive_words":"","body_shape":0,"face_shape":0,"street_address":"","city":"Oakland","state":"CA","zipcode":"","country":"USA","notes":null,"stripe_cust_id":"cus_6z7mIuqTPBQ5M2","platform_stripe_cust_id":null,"created":"2014-09-20 15:17:42","modified":"2018-01-13 02:47:48","full_name":"Alice Smith","ClientsPhoto":[{"id":100,"client_id":1517,"filename":"1517_554bae9da81ed.jpg","is_primary":1,"x":277,"y":65,"width":379,"height":379,"created":"2015-05-07 12:27:41","modified":"2015-05-12 18:51:56","timestamp":1518883056}],"hasMultiplePhotos":false}]},"167":{"Invoice":{"id":167,"user_id":102,"client_id":1830,"is_order":0,"slug":"3B910D66-210E-458D-9837-2EBBDA654E28","client_name":"Jane Doe","client_address":", <br>Santa Monica, CA  <br>janedoe@gmail.com","email":"janedoe@gmail.com","notes":"","total":180,"due_date":"March 5, 2016","status":"Outstanding","paid_date":null,"last_four":null,"card_brand":null,"stripe_invoice_id":null,"created":"February 27, 2016","modified":"2016-02-27 15:42:46","manually_marked_paid":0,"created_date_formatted":1456612966,"due_date_formatted":1457161200,"timestamp":1518883056},"User":{"id":102,"account_type":0,"first_name":"Consultant","last_name":"Example","email":"youremail@consultant.com","username":"Demo","password":"$2a$10$meZ3MznWbyA9sNnU8z9y.OlDnQrKxAXHmKXQ7ittB5m0vLbwSNbFC","role":0,"use_custom_branding":1,"company_name":"Your Image Company","company_url":"yourimagecompany.com","pricing_plan_id":1,"active_months":null,"access_code":null,"trial_end_date":null,"current_until_date":null,"payment_period_start_date":null,"card_last_4":1234,"billing_name":"Your Name","card_exp_month":5,"card_exp_year":2019,"menswear_enabled":0,"stripe_token":"cus_4nkdKICI0eQFca","statement_descriptor":"Image Company","connect_access_token":"sk_live_FGq5kvnjHD5bLccLb96OQKFS","connect_refresh_token":"rt_6vne4Cdl8DN1GkttYbdRO0cAuG5M6BXAL3TTW1FxM2ITpYG9","connect_publishable_key":"pk_live_AkmblvyPIy9vunmBVE5cRCoN","connect_user_id":"acct_16hvkGKtN1DilZXw","created":"2014-09-18 11:54:21","modified":"2017-10-19 11:03:25"},"Client":[{"id":1830,"user_id":102,"unique_code":"102H&SL3oh","intake_form_id":null,"email":"janedoe@gmail.com","first_name":"Jane","last_name":"Doe","birthday":"","anniversary":"","follow_up_date":"2017-03-29 00:00:00","height":"","age":"","sex":"female","phone":"(949) 273-2373","shoe_size":"","pant_inseam":"","bust":"","waist":"","hips":"","descriptive_words":"","body_shape":0,"face_shape":0,"street_address":"","city":"Santa Monica","state":"CA","zipcode":"","country":"USA","notes":"Wants to work with me again this spring","stripe_cust_id":null,"platform_stripe_cust_id":null,"created":"2015-03-19 15:03:25","modified":"2018-02-14 09:59:17","full_name":"Jane Doe","ClientsPhoto":[{"id":76,"client_id":1830,"filename":"1830_554af9323f5c3.jpg","is_primary":1,"x":0,"y":0,"width":735,"height":735,"created":"2015-05-06 23:33:38","modified":"2015-05-06 23:33:47","timestamp":1518883056}],"hasMultiplePhotos":false}]},"166":{"Invoice":{"id":166,"user_id":102,"client_id":1517,"is_order":0,"slug":"5C0274B9-CD19-4605-9C15-261ED44AC239","client_name":"Alice Smith","client_address":", <br>Oakland, CA  <br>test@gmail.com","email":"test@gmail.com","notes":"","total":273.63,"due_date":"March 4, 2016","status":"Outstanding","paid_date":null,"last_four":null,"card_brand":null,"stripe_invoice_id":null,"created":"February 26, 2016","modified":"2016-02-26 20:15:47","manually_marked_paid":0,"created_date_formatted":1456542947,"due_date_formatted":1457074800,"timestamp":1518883056},"User":{"id":102,"account_type":0,"first_name":"Consultant","last_name":"Example","email":"youremail@consultant.com","username":"Demo","password":"$2a$10$meZ3MznWbyA9sNnU8z9y.OlDnQrKxAXHmKXQ7ittB5m0vLbwSNbFC","role":0,"use_custom_branding":1,"company_name":"Your Image Company","company_url":"yourimagecompany.com","pricing_plan_id":1,"active_months":null,"access_code":null,"trial_end_date":null,"current_until_date":null,"payment_period_start_date":null,"card_last_4":1234,"billing_name":"Your Name","card_exp_month":5,"card_exp_year":2019,"menswear_enabled":0,"stripe_token":"cus_4nkdKICI0eQFca","statement_descriptor":"Image Company","connect_access_token":"sk_live_FGq5kvnjHD5bLccLb96OQKFS","connect_refresh_token":"rt_6vne4Cdl8DN1GkttYbdRO0cAuG5M6BXAL3TTW1FxM2ITpYG9","connect_publishable_key":"pk_live_AkmblvyPIy9vunmBVE5cRCoN","connect_user_id":"acct_16hvkGKtN1DilZXw","created":"2014-09-18 11:54:21","modified":"2017-10-19 11:03:25"},"Client":[{"id":1517,"user_id":102,"unique_code":"102H&SU1NU","intake_form_id":null,"email":"test@gmail.com","first_name":"Alice","last_name":"Smith","birthday":"","anniversary":"","follow_up_date":"2016-04-13 00:00:00","height":"","age":"","sex":"female","phone":"","shoe_size":"","pant_inseam":"","bust":"","waist":"","hips":"","descriptive_words":"","body_shape":0,"face_shape":0,"street_address":"","city":"Oakland","state":"CA","zipcode":"","country":"USA","notes":null,"stripe_cust_id":"cus_6z7mIuqTPBQ5M2","platform_stripe_cust_id":null,"created":"2014-09-20 15:17:42","modified":"2018-01-13 02:47:48","full_name":"Alice Smith","ClientsPhoto":[{"id":100,"client_id":1517,"filename":"1517_554bae9da81ed.jpg","is_primary":1,"x":277,"y":65,"width":379,"height":379,"created":"2015-05-07 12:27:41","modified":"2015-05-12 18:51:56","timestamp":1518883056}],"hasMultiplePhotos":false}]},"78":{"Invoice":{"id":78,"user_id":102,"client_id":1569,"is_order":0,"slug":"671DEB55-8779-4AE3-9421-A7C0E77D60FE","client_name":"Jane Bartlett","client_address":", <br>New York, NY  <br>test2@gmail.com","email":"test2@gmail.com","notes":"","total":90,"due_date":"October 20, 2015","status":"Outstanding","paid_date":null,"last_four":null,"card_brand":null,"stripe_invoice_id":null,"created":"October 13, 2015","modified":"2015-10-13 17:53:26","manually_marked_paid":0,"created_date_formatted":1444780406,"due_date_formatted":1445320800,"timestamp":1518883056},"User":{"id":102,"account_type":0,"first_name":"Consultant","last_name":"Example","email":"youremail@consultant.com","username":"Demo","password":"$2a$10$meZ3MznWbyA9sNnU8z9y.OlDnQrKxAXHmKXQ7ittB5m0vLbwSNbFC","role":0,"use_custom_branding":1,"company_name":"Your Image Company","company_url":"yourimagecompany.com","pricing_plan_id":1,"active_months":null,"access_code":null,"trial_end_date":null,"current_until_date":null,"payment_period_start_date":null,"card_last_4":1234,"billing_name":"Your Name","card_exp_month":5,"card_exp_year":2019,"menswear_enabled":0,"stripe_token":"cus_4nkdKICI0eQFca","statement_descriptor":"Image Company","connect_access_token":"sk_live_FGq5kvnjHD5bLccLb96OQKFS","connect_refresh_token":"rt_6vne4Cdl8DN1GkttYbdRO0cAuG5M6BXAL3TTW1FxM2ITpYG9","connect_publishable_key":"pk_live_AkmblvyPIy9vunmBVE5cRCoN","connect_user_id":"acct_16hvkGKtN1DilZXw","created":"2014-09-18 11:54:21","modified":"2017-10-19 11:03:25"},"Client":[{"id":1569,"user_id":102,"unique_code":"102H&SktIk","intake_form_id":null,"email":"test2@gmail.com","first_name":"Jane","last_name":"Bartlett","birthday":null,"anniversary":null,"follow_up_date":null,"height":"","age":"","sex":"female","phone":"","shoe_size":"","pant_inseam":"","bust":"","waist":"","hips":"","descriptive_words":"","body_shape":0,"face_shape":0,"street_address":"","city":"New York","state":"NY","zipcode":"","country":"USA","notes":"Time more important than money.  High up in an accounting firm.  Personality is more reserved.","stripe_cust_id":null,"platform_stripe_cust_id":null,"created":"2014-10-23 10:43:10","modified":"2015-07-23 17:23:02","full_name":"Jane Bartlett","ClientsPhoto":[{"id":77,"client_id":1569,"filename":"1569_554af9501df18.jpg","is_primary":1,"x":0,"y":0,"width":653,"height":653,"created":"2015-05-06 23:34:08","modified":"2015-07-08 09:04:21","timestamp":1518883056}],"hasMultiplePhotos":false}]},"77":{"Invoice":{"id":77,"user_id":102,"client_id":2124,"is_order":0,"slug":"F29A8CB1-BEA3-42D1-AAFC-0DA6323B0218","client_name":"John Doe","client_address":"419 My Lane, <br>Columbus, OH 60131 <br>john.doe@gmail.com","email":"john.doe@gmail.com","notes":"","total":150,"due_date":"October 20, 2015","status":"Outstanding","paid_date":null,"last_four":null,"card_brand":null,"stripe_invoice_id":null,"created":"October 13, 2015","modified":"2015-10-13 17:48:16","manually_marked_paid":0,"created_date_formatted":1444780096,"due_date_formatted":1445320800,"timestamp":1518883056},"User":{"id":102,"account_type":0,"first_name":"Consultant","last_name":"Example","email":"youremail@consultant.com","username":"Demo","password":"$2a$10$meZ3MznWbyA9sNnU8z9y.OlDnQrKxAXHmKXQ7ittB5m0vLbwSNbFC","role":0,"use_custom_branding":1,"company_name":"Your Image Company","company_url":"yourimagecompany.com","pricing_plan_id":1,"active_months":null,"access_code":null,"trial_end_date":null,"current_until_date":null,"payment_period_start_date":null,"card_last_4":1234,"billing_name":"Your Name","card_exp_month":5,"card_exp_year":2019,"menswear_enabled":0,"stripe_token":"cus_4nkdKICI0eQFca","statement_descriptor":"Image Company","connect_access_token":"sk_live_FGq5kvnjHD5bLccLb96OQKFS","connect_refresh_token":"rt_6vne4Cdl8DN1GkttYbdRO0cAuG5M6BXAL3TTW1FxM2ITpYG9","connect_publishable_key":"pk_live_AkmblvyPIy9vunmBVE5cRCoN","connect_user_id":"acct_16hvkGKtN1DilZXw","created":"2014-09-18 11:54:21","modified":"2017-10-19 11:03:25"},"Client":[{"id":2124,"user_id":102,"unique_code":"102H&SigHq","intake_form_id":null,"email":"john.doe@gmail.com","first_name":"John","last_name":"Doe","birthday":"","anniversary":"","follow_up_date":"2017-08-23 00:00:00","height":"5'10","age":39,"sex":"male","phone":"(800) 123-6787","shoe_size":"","pant_inseam":"","bust":"","waist":"","hips":"","descriptive_words":"","body_shape":0,"face_shape":0,"street_address":"419 My Lane","city":"Columbus","state":"OH","zipcode":60131,"country":"USA","notes":"In the middle of a job transition. Needs help to look his best during his job interviews. ","stripe_cust_id":null,"platform_stripe_cust_id":null,"created":"2015-06-25 09:51:47","modified":"2018-02-02 09:48:02","full_name":"John Doe","ClientsPhoto":[{"id":207,"client_id":2124,"filename":"2124_558c2394c4cbe.jpg","is_primary":1,"x":6,"y":0,"width":120,"height":120,"created":"2015-06-25 09:51:48","modified":"2015-06-25 09:51:48","timestamp":1518883056}],"hasMultiplePhotos":false}]},"76":{"Invoice":{"id":76,"user_id":102,"client_id":1583,"is_order":0,"slug":"76B15156-7D93-4C32-A5C5-01958BDDD2BA","client_name":"Emma Rock","client_address":", <br>Scottsdale, AZ  <br>test3@gmail.com","email":"test3@gmail.com","notes":"","total":100,"due_date":"October 20, 2015","status":"Outstanding","paid_date":null,"last_four":null,"card_brand":null,"stripe_invoice_id":null,"created":"October 13, 2015","modified":"2015-10-13 17:47:32","manually_marked_paid":0,"created_date_formatted":1444780052,"due_date_formatted":1445320800,"timestamp":1518883056},"User":{"id":102,"account_type":0,"first_name":"Consultant","last_name":"Example","email":"youremail@consultant.com","username":"Demo","password":"$2a$10$meZ3MznWbyA9sNnU8z9y.OlDnQrKxAXHmKXQ7ittB5m0vLbwSNbFC","role":0,"use_custom_branding":1,"company_name":"Your Image Company","company_url":"yourimagecompany.com","pricing_plan_id":1,"active_months":null,"access_code":null,"trial_end_date":null,"current_until_date":null,"payment_period_start_date":null,"card_last_4":1234,"billing_name":"Your Name","card_exp_month":5,"card_exp_year":2019,"menswear_enabled":0,"stripe_token":"cus_4nkdKICI0eQFca","statement_descriptor":"Image Company","connect_access_token":"sk_live_FGq5kvnjHD5bLccLb96OQKFS","connect_refresh_token":"rt_6vne4Cdl8DN1GkttYbdRO0cAuG5M6BXAL3TTW1FxM2ITpYG9","connect_publishable_key":"pk_live_AkmblvyPIy9vunmBVE5cRCoN","connect_user_id":"acct_16hvkGKtN1DilZXw","created":"2014-09-18 11:54:21","modified":"2017-10-19 11:03:25"},"Client":[{"id":1583,"user_id":102,"unique_code":"102H&SWVxc","intake_form_id":null,"email":"clientemail@gmail.com","first_name":"Emma","last_name":"Rock","birthday":"","anniversary":"","follow_up_date":"2018-03-22 00:00:00","height":"5'5","age":27,"sex":"female","phone":"(123) 456-7890","shoe_size":"","pant_inseam":"","bust":"","waist":"","hips":"","descriptive_words":"","body_shape":0,"face_shape":0,"street_address":"","city":"Scottsdale","state":"AZ","zipcode":"","country":"USA","notes":"Do a wardrobe refresh this spring\n\nHelped her prepare for her promotional tour\n\n","stripe_cust_id":null,"platform_stripe_cust_id":null,"created":"2014-11-07 13:21:59","modified":"2018-02-16 11:37:52","full_name":"Emma Rock","ClientsPhoto":[{"id":1762,"client_id":1583,"filename":"1583_587e87cc32364.jpg","is_primary":1,"x":0,"y":0,"width":980,"height":980,"created":"2017-01-17 14:08:28","modified":"2017-01-17 14:08:28","timestamp":1518883056}],"hasMultiplePhotos":false}]},"59":{"Invoice":{"id":59,"user_id":102,"client_id":1517,"is_order":0,"slug":"D2754B8E-891D-4A73-A123-104921531208","client_name":"Alice Smith","client_address":", <br>Oakland, CA  <br>wellstyled@gmail.com","email":"wellstyled@gmail.com","notes":"Hello and welcome.","total":1,"due_date":"September 21, 2015","status":"Paid","paid_date":"2015-09-14 08:50:22","last_four":1792,"card_brand":"Visa","stripe_invoice_id":"ch_16l9WTKtN1DilZXwQ81Gwwsm","created":"September 14, 2015","modified":"2015-09-14 20:50:22","manually_marked_paid":0,"created_date_formatted":1442285181,"due_date_formatted":1442815200,"timestamp":1518883056},"User":{"id":102,"account_type":0,"first_name":"Consultant","last_name":"Example","email":"youremail@consultant.com","username":"Demo","password":"$2a$10$meZ3MznWbyA9sNnU8z9y.OlDnQrKxAXHmKXQ7ittB5m0vLbwSNbFC","role":0,"use_custom_branding":1,"company_name":"Your Image Company","company_url":"yourimagecompany.com","pricing_plan_id":1,"active_months":null,"access_code":null,"trial_end_date":null,"current_until_date":null,"payment_period_start_date":null,"card_last_4":1234,"billing_name":"Your Name","card_exp_month":5,"card_exp_year":2019,"menswear_enabled":0,"stripe_token":"cus_4nkdKICI0eQFca","statement_descriptor":"Image Company","connect_access_token":"sk_live_FGq5kvnjHD5bLccLb96OQKFS","connect_refresh_token":"rt_6vne4Cdl8DN1GkttYbdRO0cAuG5M6BXAL3TTW1FxM2ITpYG9","connect_publishable_key":"pk_live_AkmblvyPIy9vunmBVE5cRCoN","connect_user_id":"acct_16hvkGKtN1DilZXw","created":"2014-09-18 11:54:21","modified":"2017-10-19 11:03:25"},"Client":[{"id":1517,"user_id":102,"unique_code":"102H&SU1NU","intake_form_id":null,"email":"test@gmail.com","first_name":"Alice","last_name":"Smith","birthday":"","anniversary":"","follow_up_date":"2016-04-13 00:00:00","height":"","age":"","sex":"female","phone":"","shoe_size":"","pant_inseam":"","bust":"","waist":"","hips":"","descriptive_words":"","body_shape":0,"face_shape":0,"street_address":"","city":"Oakland","state":"CA","zipcode":"","country":"USA","notes":null,"stripe_cust_id":"cus_6z7mIuqTPBQ5M2","platform_stripe_cust_id":null,"created":"2014-09-20 15:17:42","modified":"2018-01-13 02:47:48","full_name":"Alice Smith","ClientsPhoto":[{"id":100,"client_id":1517,"filename":"1517_554bae9da81ed.jpg","is_primary":1,"x":277,"y":65,"width":379,"height":379,"created":"2015-05-07 12:27:41","modified":"2015-05-12 18:51:56","timestamp":1518883056}],"hasMultiplePhotos":false}]},"58":{"Invoice":{"id":58,"user_id":102,"client_id":1517,"is_order":0,"slug":"253C3508-3683-421C-90B4-E72AF5BD5911","client_name":"Alice Smith","client_address":", <br>Oakland, CA  <br>test@gmail.com","email":"test@gmail.com","notes":"Had a great time with you. Hope you enjoy your new outfits!","total":200,"due_date":"November 18, 2015","status":"Paid","paid_date":"2018-01-13 02:40:06","last_four":null,"card_brand":null,"stripe_invoice_id":null,"created":"September 14, 2015","modified":"2018-01-13 14:40:06","manually_marked_paid":1,"created_date_formatted":1442251809,"due_date_formatted":1447830000,"timestamp":1518883056},"User":{"id":102,"account_type":0,"first_name":"Consultant","last_name":"Example","email":"youremail@consultant.com","username":"Demo","password":"$2a$10$meZ3MznWbyA9sNnU8z9y.OlDnQrKxAXHmKXQ7ittB5m0vLbwSNbFC","role":0,"use_custom_branding":1,"company_name":"Your Image Company","company_url":"yourimagecompany.com","pricing_plan_id":1,"active_months":null,"access_code":null,"trial_end_date":null,"current_until_date":null,"payment_period_start_date":null,"card_last_4":1234,"billing_name":"Your Name","card_exp_month":5,"card_exp_year":2019,"menswear_enabled":0,"stripe_token":"cus_4nkdKICI0eQFca","statement_descriptor":"Image Company","connect_access_token":"sk_live_FGq5kvnjHD5bLccLb96OQKFS","connect_refresh_token":"rt_6vne4Cdl8DN1GkttYbdRO0cAuG5M6BXAL3TTW1FxM2ITpYG9","connect_publishable_key":"pk_live_AkmblvyPIy9vunmBVE5cRCoN","connect_user_id":"acct_16hvkGKtN1DilZXw","created":"2014-09-18 11:54:21","modified":"2017-10-19 11:03:25"},"Client":[{"id":1517,"user_id":102,"unique_code":"102H&SU1NU","intake_form_id":null,"email":"test@gmail.com","first_name":"Alice","last_name":"Smith","birthday":"","anniversary":"","follow_up_date":"2016-04-13 00:00:00","height":"","age":"","sex":"female","phone":"","shoe_size":"","pant_inseam":"","bust":"","waist":"","hips":"","descriptive_words":"","body_shape":0,"face_shape":0,"street_address":"","city":"Oakland","state":"CA","zipcode":"","country":"USA","notes":null,"stripe_cust_id":"cus_6z7mIuqTPBQ5M2","platform_stripe_cust_id":null,"created":"2014-09-20 15:17:42","modified":"2018-01-13 02:47:48","full_name":"Alice Smith","ClientsPhoto":[{"id":100,"client_id":1517,"filename":"1517_554bae9da81ed.jpg","is_primary":1,"x":277,"y":65,"width":379,"height":379,"created":"2015-05-07 12:27:41","modified":"2015-05-12 18:51:56","timestamp":1518883056}],"hasMultiplePhotos":false}]}};
			var orderDataSource = [];
			var newClientFormData = {};
			var pastCharges = {"1583":[{"Invoice":{"id":787,"user_id":102,"client_id":1583,"is_order":0,"slug":"DEF5664A-2CCD-4825-81CA-A5DBA34617A4","client_name":"Emma Rock","client_address":", <br>Scottsdale, AZ  <br>clientemail@gmail.com","email":"clientemail@gmail.com","notes":"pay me!!","total":100,"due_date":"2017-04-04 00:00:00","status":"Void","paid_date":null,"last_four":null,"card_brand":null,"stripe_invoice_id":null,"created":"2017-03-28 13:20:36","modified":"2017-03-28 13:21:17","manually_marked_paid":0,"invoiceDueDate":"Apr 04, 2017","invoiceDueDate_unix":1491285600,"invoice_date":"Mar 28, 2017","invoice_date_unix":1490728836}},{"Invoice":{"id":786,"user_id":102,"client_id":1583,"is_order":0,"slug":"9FBC85B2-C33C-4FEC-822A-F7CDF808828B","client_name":"Emma Rock","client_address":", <br>Scottsdale, AZ  <br>clientemail@gmail.com","email":"clientemail@gmail.com","notes":"","total":20,"due_date":"2017-04-04 00:00:00","status":"Paid","paid_date":"2017-06-14 08:07:35","last_four":null,"card_brand":null,"stripe_invoice_id":null,"created":"2017-03-28 13:20:35","modified":"2017-06-14 08:07:35","manually_marked_paid":1,"invoiceDueDate":"Apr 04, 2017","invoiceDueDate_unix":1491285600,"invoice_date":"Mar 28, 2017","invoice_date_unix":1490728835}},{"Invoice":{"id":487,"user_id":102,"client_id":1583,"is_order":0,"slug":"CBAF8C7F-8BC1-4623-99B2-4B0243BF848A","client_name":"Emma Rock","client_address":", <br>Scottsdale, AZ  <br>clientemail@gmail.com","email":"clientemail@gmail.com","notes":"","total":300,"due_date":"2016-11-18 00:00:00","status":"Outstanding","paid_date":null,"last_four":null,"card_brand":null,"stripe_invoice_id":null,"created":"2016-11-11 12:36:48","modified":"2016-11-11 12:36:48","manually_marked_paid":0,"invoiceDueDate":"Nov 18, 2016","invoiceDueDate_unix":1479452400,"invoice_date":"Nov 11, 2016","invoice_date_unix":1478893008}},{"Invoice":{"id":382,"user_id":102,"client_id":1583,"is_order":0,"slug":"9087C420-3B6C-4C5C-90D7-FBB862AD86BE","client_name":"Emma Rock","client_address":", <br>Scottsdale, AZ  <br>clientemail@gmail.com","email":"clientemail@gmail.com","notes":"Purchases from Nordstrom during the Annual Sale","total":342,"due_date":"2016-09-29 00:00:00","status":"Outstanding","paid_date":null,"last_four":null,"card_brand":null,"stripe_invoice_id":null,"created":"2016-09-22 10:33:47","modified":"2016-09-22 10:33:47","manually_marked_paid":0,"invoiceDueDate":"Sep 29, 2016","invoiceDueDate_unix":1475128800,"invoice_date":"Sep 22, 2016","invoice_date_unix":1474562027}},{"Invoice":{"id":203,"user_id":102,"client_id":1583,"is_order":0,"slug":"02E88C55-29E5-4C29-95F8-1A41DE52B440","client_name":"Emma Rock","client_address":", <br>Scottsdale, AZ  <br>test3@gmail.com","email":"test3@gmail.com","notes":"","total":180,"due_date":"2016-04-26 00:00:00","status":"Paid","paid_date":"2016-07-07 01:35:56","last_four":null,"card_brand":null,"stripe_invoice_id":null,"created":"2016-04-19 11:17:49","modified":"2016-07-07 13:35:56","manually_marked_paid":1,"invoiceDueDate":"Apr 26, 2016","invoiceDueDate_unix":1461650400,"invoice_date":"Apr 19, 2016","invoice_date_unix":1461086269}},{"Invoice":{"id":198,"user_id":102,"client_id":1583,"is_order":0,"slug":"DD6BDE90-7023-4294-9BF8-2AB113694E6B","client_name":"Emma Rock","client_address":", <br>Scottsdale, AZ  <br>test3@gmail.com","email":"test3@gmail.com","notes":"Thank you ","total":324,"due_date":"2016-04-13 00:00:00","status":"Paid","paid_date":"2016-07-13 10:09:24","last_four":null,"card_brand":null,"stripe_invoice_id":null,"created":"2016-04-13 10:19:59","modified":"2016-07-13 10:09:24","manually_marked_paid":1,"invoiceDueDate":"Apr 13, 2016","invoiceDueDate_unix":1460527200,"invoice_date":"Apr 13, 2016","invoice_date_unix":1460564399}},{"Invoice":{"id":76,"user_id":102,"client_id":1583,"is_order":0,"slug":"76B15156-7D93-4C32-A5C5-01958BDDD2BA","client_name":"Emma Rock","client_address":", <br>Scottsdale, AZ  <br>test3@gmail.com","email":"test3@gmail.com","notes":"","total":100,"due_date":"2015-10-20 00:00:00","status":"Outstanding","paid_date":null,"last_four":null,"card_brand":null,"stripe_invoice_id":null,"created":"2015-10-13 17:47:32","modified":"2015-10-13 17:47:32","manually_marked_paid":0,"invoiceDueDate":"Oct 20, 2015","invoiceDueDate_unix":1445320800,"invoice_date":"Oct 13, 2015","invoice_date_unix":1444780052}}],"1517":[{"Invoice":{"id":260,"user_id":102,"client_id":1517,"is_order":0,"slug":"939BD065-049E-408D-A079-E5C9CB2C7B2C","client_name":"Alice Smith","client_address":", <br>Oakland, CA  <br>test@gmail.com","email":"test@gmail.com","notes":"","total":300,"due_date":"2016-06-21 00:00:00","status":"Paid","paid_date":"2016-07-07 01:34:57","last_four":null,"card_brand":null,"stripe_invoice_id":null,"created":"2016-06-14 10:11:59","modified":"2016-07-07 13:34:57","manually_marked_paid":1,"invoiceDueDate":"Jun 21, 2016","invoiceDueDate_unix":1466488800,"invoice_date":"Jun 14, 2016","invoice_date_unix":1465920719}},{"Invoice":{"id":168,"user_id":102,"client_id":1517,"is_order":0,"slug":"AA9FC3F8-F40C-4152-9F3B-DBF567E6A8A0","client_name":"Alice Smith","client_address":", <br>Oakland, CA  <br>test@gmail.com","email":"test@gmail.com","notes":"","total":540,"due_date":"2016-03-05 00:00:00","status":"Void","paid_date":null,"last_four":null,"card_brand":null,"stripe_invoice_id":null,"created":"2016-02-27 17:12:20","modified":"2016-03-17 19:09:59","manually_marked_paid":0,"invoiceDueDate":"Mar 05, 2016","invoiceDueDate_unix":1457161200,"invoice_date":"Feb 27, 2016","invoice_date_unix":1456618340}},{"Invoice":{"id":166,"user_id":102,"client_id":1517,"is_order":0,"slug":"5C0274B9-CD19-4605-9C15-261ED44AC239","client_name":"Alice Smith","client_address":", <br>Oakland, CA  <br>test@gmail.com","email":"test@gmail.com","notes":"","total":273.63,"due_date":"2016-03-04 00:00:00","status":"Outstanding","paid_date":null,"last_four":null,"card_brand":null,"stripe_invoice_id":null,"created":"2016-02-26 20:15:47","modified":"2016-02-26 20:15:47","manually_marked_paid":0,"invoiceDueDate":"Mar 04, 2016","invoiceDueDate_unix":1457074800,"invoice_date":"Feb 26, 2016","invoice_date_unix":1456542947}},{"Invoice":{"id":59,"user_id":102,"client_id":1517,"is_order":0,"slug":"D2754B8E-891D-4A73-A123-104921531208","client_name":"Alice Smith","client_address":", <br>Oakland, CA  <br>wellstyled@gmail.com","email":"wellstyled@gmail.com","notes":"Hello and welcome.","total":1,"due_date":"2015-09-21 00:00:00","status":"Paid","paid_date":"2015-09-14 08:50:22","last_four":1792,"card_brand":"Visa","stripe_invoice_id":"ch_16l9WTKtN1DilZXwQ81Gwwsm","created":"2015-09-14 20:46:21","modified":"2015-09-14 20:50:22","manually_marked_paid":0,"invoiceDueDate":"Sep 21, 2015","invoiceDueDate_unix":1442815200,"invoice_date":"Sep 14, 2015","invoice_date_unix":1442285181}},{"Invoice":{"id":58,"user_id":102,"client_id":1517,"is_order":0,"slug":"253C3508-3683-421C-90B4-E72AF5BD5911","client_name":"Alice Smith","client_address":", <br>Oakland, CA  <br>test@gmail.com","email":"test@gmail.com","notes":"Had a great time with you. Hope you enjoy your new outfits!","total":200,"due_date":"2015-11-18 00:00:00","status":"Paid","paid_date":"2018-01-13 02:40:06","last_four":null,"card_brand":null,"stripe_invoice_id":null,"created":"2015-09-14 11:30:09","modified":"2018-01-13 14:40:06","manually_marked_paid":1,"invoiceDueDate":"Nov 18, 2015","invoiceDueDate_unix":1447830000,"invoice_date":"Sep 14, 2015","invoice_date_unix":1442251809}}],"3838":[{"Invoice":{"id":209,"user_id":102,"client_id":3838,"is_order":0,"slug":"4F10FBE7-C831-4876-A969-B6663B10F2FD","client_name":"Joe Shmo","client_address":", <br>youngstown, AL  <br>joshmo@gmail.com","email":"joshmo@gmail.com","notes":"Thank you! See you in September!","total":400,"due_date":"2016-05-02 00:00:00","status":"Outstanding","paid_date":null,"last_four":null,"card_brand":null,"stripe_invoice_id":null,"created":"2016-04-25 16:30:01","modified":"2016-04-25 16:30:01","manually_marked_paid":0,"invoiceDueDate":"May 02, 2016","invoiceDueDate_unix":1462168800,"invoice_date":"Apr 25, 2016","invoice_date_unix":1461623401}}],"1830":[{"Invoice":{"id":167,"user_id":102,"client_id":1830,"is_order":0,"slug":"3B910D66-210E-458D-9837-2EBBDA654E28","client_name":"Jane Doe","client_address":", <br>Santa Monica, CA  <br>janedoe@gmail.com","email":"janedoe@gmail.com","notes":"","total":180,"due_date":"2016-03-05 00:00:00","status":"Outstanding","paid_date":null,"last_four":null,"card_brand":null,"stripe_invoice_id":null,"created":"2016-02-27 15:42:46","modified":"2016-02-27 15:42:46","manually_marked_paid":0,"invoiceDueDate":"Mar 05, 2016","invoiceDueDate_unix":1457161200,"invoice_date":"Feb 27, 2016","invoice_date_unix":1456612966}}],"1569":[{"Invoice":{"id":78,"user_id":102,"client_id":1569,"is_order":0,"slug":"671DEB55-8779-4AE3-9421-A7C0E77D60FE","client_name":"Jane Bartlett","client_address":", <br>New York, NY  <br>test2@gmail.com","email":"test2@gmail.com","notes":"","total":90,"due_date":"2015-10-20 00:00:00","status":"Outstanding","paid_date":null,"last_four":null,"card_brand":null,"stripe_invoice_id":null,"created":"2015-10-13 17:53:26","modified":"2015-10-13 17:53:26","manually_marked_paid":0,"invoiceDueDate":"Oct 20, 2015","invoiceDueDate_unix":1445320800,"invoice_date":"Oct 13, 2015","invoice_date_unix":1444780406}}],"2124":[{"Invoice":{"id":77,"user_id":102,"client_id":2124,"is_order":0,"slug":"F29A8CB1-BEA3-42D1-AAFC-0DA6323B0218","client_name":"John Doe","client_address":"419 My Lane, <br>Columbus, OH 60131 <br>john.doe@gmail.com","email":"john.doe@gmail.com","notes":"","total":150,"due_date":"2015-10-20 00:00:00","status":"Outstanding","paid_date":null,"last_four":null,"card_brand":null,"stripe_invoice_id":null,"created":"2015-10-13 17:48:16","modified":"2015-10-13 17:48:16","manually_marked_paid":0,"invoiceDueDate":"Oct 20, 2015","invoiceDueDate_unix":1445320800,"invoice_date":"Oct 13, 2015","invoice_date_unix":1444780096}}]};

			var tableInitialized = false; //  only initialize the data table once per pageload
			var invoiceTableInitialized = false; //  only initialize the data table once per pageload
			var orderTableInitialized = false; //  only initialize the data table once per pageload
			var clientDataTable; //  the DataTable() object (javascript table-sorter plugin)
			var catalogDataTable; //  the DataTable() object (javascript table-sorter plugin)

			var commissionChart;

			renderTooltips();
			function renderTooltips() {
				$('.tooltip').tooltip('hide')
				$('[data-toggle="tooltip"]').tooltip({
					template: '<div class="tooltip success" style="width:auto;min-width:100px;" ><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',
					container: 'body'
				});
			}


			Handlebars.partials = Handlebars.templates;


			//Handlebars helpers for Client Questionnaire
			Handlebars.registerHelper('hideSection', function(sectionName, block) {
				var hiddenSections = newClientFormData.NewClientForm.hidden_sections;
				if(hiddenSections.match(new RegExp("(?:^|,)"+sectionName+"(?:,|$)"))) {
					return block.inverse(this);
				} else {
					return block.fn(this);
				}
			});
			Handlebars.registerHelper('hideSectionFully', function(sectionName, block) {
				var hiddenSections = newClientFormData.NewClientForm.hidden_sections;
				if(newClientFormData.public && hiddenSections.match(new RegExp("(?:^|,)"+sectionName+"(?:,|$)"))) {
					return block.inverse(this);
				} else {
					return block.fn(this);
				}
			});


			renderClientList();

			renderCatalogList();

			renderEarnings();

			renderInvoiceList();

			renderOrderList();


			function renderClientList() {
				$("#clientTable tbody").html('');
				if(Object.keys(clientDataSource).length > 0){ //  if there are clients
					$.each(clientDataSource, function(index, value) {
						renderClientListItem(index);
					});
					initializeDataTable();
				} else {
					var context;
					var template = Handlebars.templates['emptyClientListRow.html'](context);
					$("#clientTable tbody").append(template);
				}
			}

			function renderClientListItem(client_id) {
				var context = clientDataSource[client_id];
				context.itemCount = (context.Closet.slug in closetCounts) ? closetCounts[context.Closet.slug] : 0;
				context.itemCountPlural = context.itemCount == 0 || context.itemCount > 1;
				context.notifications = {
					finds:		context.Closet.NotificationEvent.filter( function(el){ return el.event_type_id == 1; } ).length,
					lookbook:	context.Closet.NotificationEvent.filter( function(el){ return el.event_type_id == 2; } ).length,
					owned:		context.Closet.NotificationEvent.filter( function(el){ return el.event_type_id == 3; } ).length,
				};
				context.Closet.show_closet = parseInt(context.Closet.show_closet);
				context.Closet.show_lookbook = parseInt(context.Closet.show_lookbook);
				context.Closet.show_uploads = parseInt(context.Closet.show_uploads);
				context.totalNotifications = 0;
				for(var key in context.notifications) {
					context.totalNotifications += context.notifications[key];
				}

				var template = Handlebars.templates['clientListRow.html'](context);
				var existingRow = $("#clientTable tbody tr[data-client-id='"+client_id+"']");
				if(existingRow.length) {
					if(tableInitialized) clientDataTable.row($(existingRow)).remove().draw(); // existingRow.replaceWith(template);
				}
				// else

				if(tableInitialized)
					clientDataTable.row.add($(template)).draw();
				else
					$("#clientTable tbody").append(template);
			}

			function renderCatalogList() {
				$("#catalogTable tbody").html('');
				if(Object.keys(catalogDataSource).length > 0){ //  if there are clients
					$.each(catalogDataSource, function(index, value) {
						renderCatalogListItem(index);
					});
					initializeCatalogDataTable();
				} else {
					var context;
					var template = Handlebars.templates['emptyCatalogListRow.html'](context);
					$("#catalogTable tbody").append(template);
				}
			}

			function renderCatalogListItem(catalog_id) {
				var context = catalogDataSource[catalog_id];
				context.itemCount = (context.Closet.slug in closetCounts) ? closetCounts[context.Closet.slug] : 0;
				context.itemCountPlural = context.itemCount == 0 || context.itemCount > 1;
				context.notifications = {
					finds:		context.NotificationEvent.filter( function(el){ return el.event_type_id == 1; } ).length,
					lookbook:	context.NotificationEvent.filter( function(el){ return el.event_type_id == 2; } ).length,
					owned:		context.NotificationEvent.filter( function(el){ return el.event_type_id == 3; } ).length,
				};
				context.Closet.show_closet = parseInt(context.Closet.show_closet);
				context.Closet.show_lookbook = parseInt(context.Closet.show_lookbook);
				context.Closet.show_uploads = parseInt(context.Closet.show_uploads);
				context.totalNotifications = 0;
				for(var key in context.notifications) {
					context.totalNotifications += context.notifications[key];
				}

				var template = Handlebars.templates['catalogListRow.html'](context);
				var existingRow = $("#catalogTable tbody tr[data-catalog-id='"+catalog_id+"']");
				if(existingRow.length)
					existingRow.replaceWith(template);
				else
				$("#catalogTable tbody").append(template);
			}


			function renderInvoiceList() {
				// $("#invoiceTable tbody").html('');
				if(Object.keys(invoiceDataSource).length > 0){ //  if there are invoices
					$.each(invoiceDataSource, function(index, value) {
						renderInvoiceListItem(index);
					});
					initializeInvoiceDataTable();
				} else {
					var context;
					var template = Handlebars.templates['emptyInvoiceListRow.html'](context);
					$("#invoiceTable tbody").append(template);
				}
			}

			function renderInvoiceListItem(invoice_id) {
				var context = invoiceDataSource[invoice_id];
				context.current_unix_date = 1518883057;
				context.invoiceDueDate = context.Invoice.due_date;
				context.current_date = 	 "February 17, 2018";

				var template = Handlebars.templates['invoiceListRow.html'](context);
				var existingRow = $("#invoiceTable tbody tr[data-invoice-id='"+invoice_id+"']");
				if(existingRow.length) {
					if(invoiceTableInitialized) invoiceDataTable.row($(existingRow)).remove().draw(); // existingRow.replaceWith(template);
				}

				if(invoiceTableInitialized)
					invoiceDataTable.row.add($(template)).draw();
				else
					$("#invoiceTable tbody").append(template);
			}


			function renderOrderList() {
				// $("#orderTable tbody").html('');
				if(Object.keys(orderDataSource).length > 0){ //  if there are invoices
					$.each(orderDataSource, function(index, value) {
						var existingRow = $("#orderTable tbody tr[data-invoice-id='"+index+"']");
						renderOrderListItem(index);
					});
					initializeOrderDataTable();
				} else {
					var context;
					var template = Handlebars.templates['emptyOrderListRow.html'](context);
					$("#orderTable tbody").append(template);
				}
			}

			function renderOrderListItem(invoice_id) {
				var context = orderDataSource[invoice_id];
				context.current_unix_date = 1518883057;
				context.invoiceDueDate = context.Invoice.due_date;
				context.current_date = 	 "February 17, 2018";

				var template = Handlebars.templates['invoiceListRow.html'](context);
				var existingRow = $("#orderTable tbody tr[data-invoice-id='"+invoice_id+"']");
				if(existingRow.length) {
					if(orderTableInitialized) orderDataTable.row($(existingRow)).remove().draw(); // existingRow.replaceWith(template);
				}

				if(orderTableInitialized)
					orderDataTable.row.add($(template)).draw();
				else
					$("#orderTable tbody").append(template);
			}


			function renderClientDetails(client_id) {

				var context = clientDataSource[client_id];

				context.itemCount = (context.Closet.slug in closetCounts) ? closetCounts[context.Closet.slug] : 0;
				context.itemCountPlural = context.itemCount == 0 || context.itemCount > 1;
				context.notifications = {
					finds:		context.Closet.NotificationEvent.filter( function(el){ return el.event_type_id == 1; } ).length,
					lookbook:	context.Closet.NotificationEvent.filter( function(el){ return el.event_type_id == 2; } ).length,
					owned:		context.Closet.NotificationEvent.filter( function(el){ return el.event_type_id == 3; } ).length,
				};
				context.Closet.show_closet = parseInt(context.Closet.show_closet);
				context.Closet.show_lookbook = parseInt(context.Closet.show_lookbook);
				context.Closet.show_uploads = parseInt(context.Closet.show_uploads);
				context.totalNotifications = 0;
				context.myAccountURL = '/users/edit';
				context.stripe_connect_enabled = '1';

				context.past_charges = pastCharges[client_id];
				context.current_unix_date = 1518883057;

				for(var key in context.notifications) {
					context.totalNotifications += context.notifications[key];  //Iterate over your first array and then grab the second element add the values up
				}

				$("#clientDetailsPane").html('');

                //TODO: pass FormItems to context...
                $.ajax({ // send invoiceData to backend to verify and generate response object
                    url: '/clients/getClientDetails.json',
                    data: { data: { client_id: client_id } },
                    type: "POST",
                    success: function (response) {
                        // console.log(response);
                        console.log(context);

                        if(response.success == 1) {
                            // pass object into context

                            // generate template of preview wrap
                            context.FormItem = response.formItems;
                            context.formID = response.form_id;
                            context.formInstanceID = response.form_instance_id;
                            context.clientID = response.client_id;
                            context.printableURL = '/intakeForms/printReady?id='+response.client_id;
                            console.log(context.FormItem);

                            /*
                            context.logo_url = "/img/consultantLogos/102.jpg";
                            context.current_date = "February 17, 2018";
                            context.formItems = response.formItems;

                            context.user_first_name =	"Consultant";
                            context.user_last_name = 	"Example";
                            context.user_company_name =	"Your Image Company";
                            context.user_company_url = 	"yourimagecompany.com";

                            context.logo_url = 		 "/img/consultantLogos/102.jpg";
                            context.first_name = 	 invoiceData.first_name;
                            context.last_name = 	 invoiceData.last_name;
                            context.recipient_email= invoiceData.recipient_email;
                            context.invoiceTotal = 	 invoiceData.total;
                            context.invoiceDueDate = invoiceData.due_date;
                            context.current_date = 	 "February 17, 2018";
                            context.notes = 	 	invoiceData.notes;

                            context.is_menswear = $('#newInvoiceModal').attr('data-is-menswear');

                            context.invoiceLineItems = invoiceData.lineItems;

                            // console.log(context);
                            var template = Handlebars.templates['invoicePreview.html'](context);

                            // fade in invoicePreview Wrap
                            $('#previewInvoiceBtn').addClass('hidden');
                            $('#editInvoiceBtn, #payInvoiceBtn').removeClass('hidden');
                            if(isSendable)
                                $('#sendInvoiceBtn').removeClass('hidden');
                            $('#invoicePreviewWrap').html(template);
                            $('#invoicePreviewWrap').fadeIn();
                            */

                            var template = Handlebars.templates['clientDetailsPane.html'](context); // your template minus the .js
                            $("#clientDetailsPane").append(template);

                            var template = Handlebars.templates['clientContactPane.html'](context); // your template minus the .js
                            $("#clientContactPane").append(template);

                            // console.log(context);
                            var template = Handlebars.templates['clientPhotoPane.html'](context); // your template minus the .js
                            $("#clientPhotoPane").append(template);

                            renderDatePickers()

                            $('#clientListPane').fadeOut('fast', function(){

                                $("html, body").animate({ scrollTop: 0 }, 0);

                                $('#clientDetailsPane').fadeIn('fast', function(){
                                    $('#clientProfilePic').attr('src', $('#clientProfilePic').attr('src')+'?'+new Date().getTime()).load(function(){
                                        $('#clientProfilePicWrap').css({
                                            width: $('#clientPhotoPane').width(),
                                            height: $('#clientPhotoPane').height()
                                        });
                                        $('#clientProfilePic').css({ maxWidth: $('#clientPhotoPane').width(), width: 'auto', height:'auto', maxHeight: $('#clientPhotoPane').height() });
                                        $('#clientPhotoPane table').css({ height: $('#clientPhotoPane').height() });
                                        $('#clientProfilePic').off('load');
                                    })
                                });
                            });

                        } else {
                            console.log('Error retrieving client data');
                            console.log(response);
                        }
					}
                });



			}


			function renderEarnings() {

			}




			/************************/
			/*** Invoicing Stuff ***/
			/************************/


			// Pre-populate 'selectClientModal' with client list
			$.each(clientDataSource, function(i, obj){
				$('#clientSelectionList').append('<li data-client-id="'+obj.Client.id+'">'+obj.Client.first_name+" "+obj.Client.last_name+'</li>');
			});

			var $list = $("#clientSelectionList");
			$list.children().detach().sort(function(a, b) {
				return $(a).text().localeCompare($(b).text());
			}).appendTo($list);

			$('body').on('click', '#clientSelectionList li', function(){
				$this = $(this);
				// console.log($this);
				$("#clientDetailsPane").attr('data-client-id', $this.attr('data-client-id'));
				// console.log($this.attr('data-client-id'));
				$('#selectClientModal').modal('hide');
				triggerNewInvoiceCreationModal();
			});

			$('body').on('click', '#createNewOrderBtn', function(){
				$('#newInvoiceModal').attr('data-is-menswear', '1');
			});
			$('body').on('click', '#newInvoiceBtn, #createNewInvoiceBtn', function(){
				$('#newInvoiceModal').attr('data-is-menswear', '0');
			});


			var lineItemCount = 0;
			$('body').on('click', '#newInvoiceBtn', function(){
				triggerNewInvoiceCreationModal();
			});

			function triggerNewInvoiceCreationModal(){

				$('#previewInvoiceBtn').removeClass('hidden');
				$('#editInvoiceBtn, #sendInvoiceBtn, #payInvoiceBtn').addClass('hidden');

				lineItemCount = 0;

				var client_id = $("#clientDetailsPane").attr('data-client-id');

				// render invoice modal based off template
				var context = clientDataSource[client_id].Client;
				context.logo_url = "/img/consultantLogos/102.jpg";
				context.current_date = "February 17, 2018";
				context.due_date = "February 24, 2018";

				context.is_menswear = $('#newInvoiceModal').attr('data-is-menswear');

				context.user_first_name =	"Consultant";
				context.user_last_name = 	"Example";
				context.user_company_name =	"Your Image Company";
				context.user_company_url = 	"yourimagecompany.com";

				// console.log(context);
				// console.log(Handlebars);
				var template = Handlebars.templates['createInvoiceModalBody.html'](context);

				$('#newInvoiceModalContent .modal-body').html(template);

				//initialize calendar to today's date
				$('#newInvoiceModalContent .modal-body').find('tbody tr.lineItemRow').find('.lineItemDate').pikaday({
					minDate: new Date('1915-01-01'),
					maxDate: new Date('2020-12-31'),
					setDefaultDate: true,
					defaultDate: new Date(),
					yearRange: [1990,2025],
				});
				$('#topInvoiceDueDate').pikaday({
					minDate: new Date('1915-01-01'),
					maxDate: new Date('2020-12-31'),
					setDefaultDate: true,
					defaultDate: new Date("2018/02/24"),
					yearRange: [1990,2025],
					onSelect: function(){
						$('#invoiceDueDate').val($('#topInvoiceDueDate').val());
					}
				});
				$('#invoiceDueDate').pikaday({
					minDate: new Date('1915-01-01'),
					maxDate: new Date('2020-12-31'),
					setDefaultDate: true,
					defaultDate: new Date("2018/02/24"),
					yearRange: [1990,2025],
					onSelect: function(){
						$('#topInvoiceDueDate').val($('#invoiceDueDate').val());
					}
				});



				// show modal
				showModalBackground();

				$this = $('#newInvoiceBtn');
				$btn = $this;

				if($this.length > 0) {
					bodyScrollPos = $(window).scrollTop();
					var offset = $this[0].getBoundingClientRect();

					$('#newInvoiceModal').addClass('open').show().css({
						left: offset.left,
						right: $(window).width() - (offset.left + $this.outerWidth()),
						top: offset.top,
						bottom: $(window).height() - (offset.top + $this.outerHeight()),
						zIndex: 1030,
						maxWidth: '900px',
						boxShadow: 'none',
						backgroundColor:$btn.css('backgroundColor'),
						overflow: 'hidden'
					}).animate({
						left: ($(window).width() * .0025),
						right: ($(window).width() * .0025),
						top: 20,
						bottom: 20,
						margin:'0 auto',
						boxShadow: '0px 0px 53px 33px rgba(0, 0, 0, 0.39)',
						backgroundColor: 'white'
					},
					300,
					"easein",
					function(){
						$('body').css('width', $('body').css('width')).css('overflow', 'hidden');
						$('#newInvoiceModal').css('overflow','auto');
						// $('#photoUploadModalContent').fadeIn(100)
					});
				} else {
					$('#newInvoiceModal').addClass('open').show().css({
						left: ($(window).width() * .0025),
						right: ($(window).width() * .0025),
						top: 20,
						bottom: 20,
						zIndex: 1030,
						margin:'0 auto',
						maxWidth: '900px',
						boxShadow: '0px 0px 53px 33px rgba(0, 0, 0, 0.39)',
						backgroundColor: 'white'
					});
					$('body').css('width', $('body').css('width')).css('overflow', 'hidden');
					$('#newInvoiceModal').css('overflow','auto');
				}
			}

			$('body').on('click', '#closeNewInvoiceModal', function(e){
				e.preventDefault();
				var $uploadBtn = $('#clientDetailsPane').css('display') == 'none' ? $('#createNewInvoiceBtn') : $('#newInvoiceBtn');
				var $uploadBtn = $('#menswearPageBtn').hasClass('active') ? $('#createNewOrderBtn') : $uploadBtn;
				$('#newInvoiceModal').removeClass('open').css('overflow','hidden');;
				$uploadBtn.removeClass('open');
				bodyScrollPos = $(window).scrollTop();
				var modalOffset = $('#newInvoiceModal')[0].getBoundingClientRect();
				var btnOffset = $uploadBtn[0].getBoundingClientRect();

				$('#newInvoiceModal').show().css({
					left: modalOffset.left,
					right: $(window).width() - (modalOffset.left + $('#newInvoiceModal').outerWidth()),
					top: modalOffset.top,
					bottom: $(window).height() - (modalOffset.top + $('#newInvoiceModal').outerHeight()),
					// width: $this.outerWidth(),
					zIndex: 99999,
					boxShadow: '0px 0px 53px 33px rgba(0, 0, 0, 0.39)',
					backgroundColor:'#FFFFFF'
				}).animate({
					left: btnOffset.left,
					right: $(window).width() - (btnOffset.left + $uploadBtn.outerWidth()),
					top: btnOffset.top,
					bottom: $(window).height() - (btnOffset.top + $uploadBtn.outerHeight()),
					boxShadow: 'none',
					backgroundColor:$uploadBtn.css('backgroundColor')
				},
				300,
				"easein",
				function(){
					$('#newInvoiceModal').hide();
					$('body').css({'width':'', 'overflow':'auto'});
					hideModalBackground();
				});
			});


			function getInvoiceDataFromModal(){
				var client_id = $("#clientDetailsPane").attr('data-client-id');
				var clientData = clientDataSource[client_id].Client;

				// get line items and total into object
				var invoiceData = {};
				var invoiceLineItems = [];
				invoiceData.client_id = clientData.id;
				invoiceData.first_name = clientData.first_name;
				invoiceData.last_name = clientData.last_name;
				invoiceData.recipient_email = $('#invoiceRecipientEmail').val();
				invoiceData.notes = $('#invoiceNotes').val();

				invoiceData.total = $('#invoiceTotal').text();
				invoiceData.due_date = $('#invoiceDueDate').val();

				$('#newInvoiceForm .transactionTbl .lineItemRow').each(function(){
					$row = $(this);
					var $lineItemDiv = $(this).find('.lineItem:not(.hidden)').first();
					// console.log($lineItemDiv);
					var currentLineItem = {};
					switch($lineItemDiv.attr('data-type')){
						case 'hourly':
							currentLineItem.date = $row.find('.lineItemDate').val();
							currentLineItem.type = 'hourly';
							currentLineItem.hours = (isNaN(parseFloat($lineItemDiv.find('.lineItemHours').val()))) ? 0 : parseFloat($lineItemDiv.find('.lineItemHours').val());
							currentLineItem.rate = (isNaN(parseFloat($lineItemDiv.find('.lineItemRate').val()))) ? 0 : parseFloat($lineItemDiv.find('.lineItemRate').val());
							currentLineItem.description = $lineItemDiv.find('.lineItemDescription').val();
							currentLineItem.total = $row.find('.lineTotal').val();
							break;
						case 'discount':
							var discountType = $row.find('.discountType:checked').val();
							currentLineItem.date = $row.find('.lineItemDate').val();
							currentLineItem.type = 'discount-'+discountType;
							if(discountType=='percent')
								currentLineItem.percent = (isNaN(parseFloat($lineItemDiv.find('.percentDiscount').val()))) ? 0 : parseFloat($lineItemDiv.find('.percentDiscount').val());
							currentLineItem.description = $lineItemDiv.find('.lineItemDescription').val();
							currentLineItem.total = $row.find('.lineTotal').val();
							break;
						case 'reimbursement':
							currentLineItem.date = $row.find('.lineItemDate').val();
							currentLineItem.type = 'reimbursement';
							currentLineItem.description = $lineItemDiv.find('.lineItemDescription').val();
							currentLineItem.total = $row.find('.lineTotal').val();
							break;
						case 'other':
							currentLineItem.date = $row.find('.lineItemDate').val();
							currentLineItem.type = 'other';
							currentLineItem.description = $lineItemDiv.find('.lineItemDescription').val();
							currentLineItem.total = $row.find('.lineTotal').val();
							break;
						case 'hmc-standard':
							var dt = new Date();
							var currentDate = dt.getFullYear() + "/" + (dt.getMonth() + 1) + "/" + dt.getDate();
							currentLineItem.date = currentDate; //$row.find('.lineItemDate').val();
							currentLineItem.type = $row.find('.hmcItemType').val().replace(/\s+/g, '-').toLowerCase();;
							currentLineItem.description = $lineItemDiv.find('.lineItemDescription').val();
							currentLineItem.total = $row.find('.lineTotal').val();
							break;
						default:
							break;
					}

					invoiceLineItems.push(currentLineItem);

				});
				invoiceData.lineItems = invoiceLineItems;
				return invoiceData;
			}

			$('body').on('click', '#previewInvoiceBtn', function(){
				var $wrap = $("#invoicePreviewWrap");
				$wrap.removeClass('hidden');
				$('#invoiceValidationErrors').addClass('hidden').find('ul').html('');

				var isSendable = !($('#newInvoiceModal').attr('data-is-menswear') == 1);

				invoiceData = getInvoiceDataFromModal();
				var client_id = $("#clientDetailsPane").attr('data-client-id');
				var clientData = clientDataSource[client_id].Client;

				$("#newInvoiceForm").fadeTo(400, .3, function(){
					$.ajax({ // send invoiceData to backend to verify and generate response object
						url: '/invoices/verifyDraft.json',
						data: invoiceData,
						type: "POST",
						success: function (response) {
							// console.log(response);

							if(response.success != 1) {
								$('#invoiceValidationErrors').removeClass('hidden');
								if(response.errors.length > 0)
									$('#invoiceValidationErrors').removeClass('hidden').find('ul').html(response.errors.join("<br />"));
								$("#newInvoiceForm").fadeTo(400, 1);
								$('#newInvoiceModal').animate({ scrollTop: 0 }, 'slow');
							} else {

								$("#newInvoiceForm").fadeOut(function(){
									// pass object into context
									var context = {};

									// generate template of preview wrap

									var context = clientDataSource[client_id].Client;
									context.logo_url = "/img/consultantLogos/102.jpg";
									context.current_date = "February 17, 2018";

									context.user_first_name =	"Consultant";
									context.user_last_name = 	"Example";
									context.user_company_name =	"Your Image Company";
									context.user_company_url = 	"yourimagecompany.com";

									context.logo_url = 		 "/img/consultantLogos/102.jpg";
									context.first_name = 	 invoiceData.first_name;
									context.last_name = 	 invoiceData.last_name;
									context.recipient_email= invoiceData.recipient_email;
									context.invoiceTotal = 	 invoiceData.total;
									context.invoiceDueDate = invoiceData.due_date;
									context.current_date = 	 "February 17, 2018";
									context.notes = 	 	invoiceData.notes;

									context.is_menswear = $('#newInvoiceModal').attr('data-is-menswear');

									context.invoiceLineItems = invoiceData.lineItems;

									// console.log(context);
									var template = Handlebars.templates['invoicePreview.html'](context);

									// fade in invoicePreview Wrap
									$('#previewInvoiceBtn').addClass('hidden');
									$('#editInvoiceBtn, #payInvoiceBtn').removeClass('hidden');
									if(isSendable)
										$('#sendInvoiceBtn').removeClass('hidden');
									$('#invoicePreviewWrap').html(template);
									$('#invoicePreviewWrap').fadeIn();
								});

							}
						}
					}); // end AJAX validation
				}); // end form fade Out
			});




			$('body').on('click', '#editInvoiceBtn', function(){
				$("#invoicePreviewWrap").fadeOut(function(){
					$('#previewInvoiceBtn').removeClass('hidden');
					$('#editInvoiceBtn, #sendInvoiceBtn, #payInvoiceBtn').addClass('hidden');
					$("#newInvoiceForm").fadeTo(400, 1);
				});
			});


			// Save invoice details and send via eMail
			$('body').on('click', '#sendInvoiceBtn, #payInvoiceBtn', function(){

				var sendEmail = ($(this).attr('id') == 'sendInvoiceBtn') ? 1 : 0;
				var isOrder = $('#newInvoiceModal').attr('data-is-menswear');

				invoiceData = getInvoiceDataFromModal();
				invoiceData.sendEmail = sendEmail;
				invoiceData.isOrder = isOrder;

				$("#invoicePreviewWrap").fadeTo(400, .3, function(){
					$.ajax({ // send invoiceData rto backend to verify and generate response object
						url: '/invoices/sendInvoice.json',
						data: invoiceData,
						type: "POST",
						success: function (response) {
							// console.log(response);

							if(response.success != 1) {
								$('#invoiceValidationErrors').removeClass('hidden');
								if(response.errors.length > 0)
									$('#invoiceValidationErrors').removeClass('hidden').find('ul').html(response.errors.join("<br />"));
									$("#invoicePreviewWrap").fadeTo(400, 0, function(){
										$("#newInvoiceForm").fadeTo(400, 1);
									});
							} else {
								if(response.action == 'redirect') {
									$('#fullScreenIframe').attr('data-is-order', $('#newInvoiceModal').attr('data-is-menswear'));
									$('#fullScreenIframe').addClass('open');
									$('body').css('width', $('body').css('width')).css('overflow', 'hidden');
									$('#fullScreenIframe .iframeBody').html('<iframe id="modalIframe" src="'+response.invoiceURL+'" style="width:100%;height:100%;border:none;margin:0;padding:0;">');

									$("#modalIframe").load(function (){
										$("#modalIframe").contents().find("#payInvoiceBtnAlt").click();
									});
								} else {
									returnFromPayments();
								}

								//TODO: when hitting 'return' key, do these...
							}
						}
					});
				});

			});


			$('body').on('click', '.clientChargeBtn, #invoiceTable tr:not(.emptyList), #orderTable tr:not(.emptyList)', function(e){
				e.preventDefault();
				$this = $(this);

				$this.fadeTo(400, .3, function(){

					$.ajax({
						url: '/invoices/retrieveInvoice.json',
						data: { data: { invoice_slug: $this.attr('data-slug') } },
						type: "POST",
						success: function (response) {
							// console.log(response);
							if(response.success != 1) {
								alert('Error retrieving invoice.  Please check your internet connection and try again!');
							} else {
								$('#fullScreenIframe').addClass('open');
								$('#fullScreenIframe').attr('data-is-order', $this.attr('data-is-order'));
								$('body').css('width', $('body').css('width')).css('overflow', 'hidden');
								$('#fullScreenIframe .iframeBody').html('<iframe id="modalIframe" src="'+response.invoiceURL+'" style="width:100%;height:100%;border:none;margin:0;padding:0;">');
							}
						}
					});

				});

			});

			$('body').on('click', '#returnFromPaymentBtn', function(){
				returnFromPayments();
			});

			function returnFromPayments(){

				$this = $('#returnFromPaymentBtn');
				var isOrder = $('#fullScreenIframe').attr('data-is-order')
				$this.fadeTo(400, .4);

				// check if this invoice is paid

				$('#fullScreenIframe').removeClass('open');
				$('#fullScreenIframe .iframeBody').html('');
				$('body').css('width', '').css('overflow', '');

				var client_id = $('#clientDetailsPane').attr('data-client-id');
				updateClientCharges(client_id, isOrder); // update client invoice list
				$("#invoicePreviewWrap").fadeTo(400, 1);
				$('#newInvoiceModal').hide();
				$('body').css({'width':'', 'overflow':'auto'});
				hideModalBackground();

				$this.fadeTo(400, 1);
			}




			$('body').on('click', '#refreshInvoicesBtn', function(){
				var client_id = $('#clientDetailsPane').attr('data-client-id');
				updateClientCharges(client_id);
			});

			function updateClientCharges(client_id, isOrder){

				$.when($('#clientCharges, #invoiceTable_wrapper, #orderTable_wrapper').fadeTo(400, .4)).then(function () {
					// AJAX - get new pastCharges

					$.ajax({ // send invoiceData rto backend to verify and generate response object
						url: '/invoices/getPastCharges.json',
						data: { data: { is_order: isOrder } },
						type: "POST",
						success: function (response) {
							// console.log(response);
							if(response.success == 1){
								if(response.isOrder != 1){
									pastCharges = response.past_charges; // set as new pastCharges
									invoiceDataSource = response.invoices; // set as new pastCharges

									// render new clientCharges
									var context = {};
									context.past_charges = pastCharges[client_id];
									context.current_unix_date = 1518883057;
									var template = Handlebars.templates['clientCharges.html'](context);
									$('#clientCharges').html(template);

									// render new invoice list
									renderInvoiceList();
								} else {
									orderDataSource = response.orders; // set as new pastCharges
									renderOrderList();
								}
							}
							$('#clientCharges, #invoiceTable_wrapper, #orderTable_wrapper').fadeTo(400, 1);
						}
					});


				});

			}


			$('body').on('change', '.invoiceLineItemSelect', function(){
				switch($(this).val()) {
					case 'hourly':
						$(this).hide();
						$(this).closest('td').find('.newHourlyLineItem').removeClass('hidden');
						$(this).closest('tr').find('.lineTotal').attr('readonly', true).css('backgroundColor', '#FBFBFB').val('0.00');
						break;
					case 'discount':
						$(this).hide();
						$(this).closest('td').find('.newDiscountLineItem').removeClass('hidden').addClass('visible');
						$(this).closest('tr').addClass('discount');
						$(this).closest('tr').find('.lineTotal').attr('readonly', false).css('backgroundColor', 'white').val('').addClass('discount');
						break;
					case 'reimbursement':
						$(this).hide();
						$(this).closest('td').find('.newReimbursementLineItem').removeClass('hidden').addClass('visible');
						$(this).closest('tr').find('.lineTotal').attr('readonly', false).css('backgroundColor', 'white').val('');
						break;
					case 'other':
						$(this).hide();
						$(this).closest('td').find('.newOtherLineItem').removeClass('hidden').addClass('visible');
						$(this).closest('tr').find('.lineTotal').attr('readonly', false).css('backgroundColor', 'white').val('');
						break;
					case 'hmc-suit':
						$(this).hide();
						$(this).closest('td').find('.newHMCLineItem').removeClass('hidden').addClass('visible').find('.lineItemDescription').prop('placeholder', 'Custom Suit Info ');
						$(this).closest('tr').find('.lineTotal').attr('readonly', false).css('backgroundColor', 'white').val('');
						$(this).closest('tr').find('.hmcItemType').val('Custom Suit');
						break;
					case 'hmc-shirt':
						$(this).hide();
						$(this).closest('td').find('.newHMCLineItem').removeClass('hidden').addClass('visible').find('.lineItemDescription').prop('placeholder', 'Custom Shirt Info ');
						$(this).closest('tr').find('.lineTotal').attr('readonly', false).css('backgroundColor', 'white').val('');
						$(this).closest('tr').find('.hmcItemType').val('Custom Shirt');
						break;
					case 'hmc-pant':
						$(this).hide();
						$(this).closest('td').find('.newHMCLineItem').removeClass('hidden').addClass('visible').find('.lineItemDescription').prop('placeholder', 'Custom Pant Info ');
						$(this).closest('tr').find('.lineTotal').attr('readonly', false).css('backgroundColor', 'white').val('');
						$(this).closest('tr').find('.hmcItemType').val('Custom Pant');
						break;
					case 'hmc-jacket':
						$(this).hide();
						$(this).closest('td').find('.newHMCLineItem').removeClass('hidden').addClass('visible').find('.lineItemDescription').prop('placeholder', 'Custom Jacket Info ');
						$(this).closest('tr').find('.lineTotal').attr('readonly', false).css('backgroundColor', 'white').val('');
						$(this).closest('tr').find('.hmcItemType').val('Custom Jacket');
						break;
					case 'hmc-overcoat':
						$(this).hide();
						$(this).closest('td').find('.newHMCLineItem').removeClass('hidden').addClass('visible').find('.lineItemDescription').prop('placeholder', 'Custom Overcoat Info ');
						$(this).closest('tr').find('.lineTotal').attr('readonly', false).css('backgroundColor', 'white').val('');
						$(this).closest('tr').find('.hmcItemType').val('Custom Overcoat');
						break;
					case 'hmc-other':
						$(this).hide();
						$(this).closest('td').find('.newHMCLineItem').removeClass('hidden').addClass('visible').find('.lineItemDescription').prop('placeholder', 'Custom Item Info ');
						$(this).closest('tr').find('.lineTotal').attr('readonly', false).css('backgroundColor', 'white').val('');
						$(this).closest('tr').find('.hmcItemType').val('Other Custom');
						break;
				}
			});

			$('body').on('change', '.discountType', function(){
				if($(this).val() == 'percent'){
					$(this).closest('tr').find('.percentDiscountGroup').removeClass('hidden')
					$(this).closest('tr').find('.lineTotal').attr('readonly', true).css('backgroundColor', '#FBFBFB').val('0.00');
				} else {
					$(this).closest('tr').find('.percentDiscountGroup').addClass('hidden')
					$(this).closest('tr').find('.lineTotal').attr('readonly', false).css('backgroundColor', 'white').val('');
				}
				updateInvoiceTotal();
			});

			$('body').on('change, keyup', '.percentDiscount', function(){
				var $this = $(this);
				$this.val($this.val().replace(/[^\d.]/g, ''));
				var subTotal = updateInvoiceSubTotal();
				var total = subTotal * (parseFloat($this.val()) / 100);
				var $lineItemRow = $this.closest('tr');

				if( isNaN(parseFloat($this.val())) ) {
					$this.val('');
				} else {
					$lineItemRow.find('.lineTotal').val("- "+$.precise_round(total, 2));
				}
				updateInvoiceTotal();
			});

			$('body').on('change, keyup', '.lineItemHours, .lineItemRate', function(){
				var $this = $(this);
				$this.val($this.val().replace(/[^\d.]/g, ''));

				var $lineItemRow = $(this).closest('tr');
				var hours = ($lineItemRow.find('.lineItemHours').val() == "") ? 0 : parseFloat($lineItemRow.find('.lineItemHours').val());
				var rate = ($lineItemRow.find('.lineItemRate').val() == "") ? 0 : parseFloat($lineItemRow.find('.lineItemRate').val());
				var total = hours * rate;
				$lineItemRow.find('.lineTotal').val($.precise_round(total, 2));
				updateInvoiceTotal();
			});

			var keyupTimeout;
			$('body').on('blur, change', '.lineTotal', function(){
				var $this = $(this);
				if(keyupTimeout) clearTimeout(keyupTimeout);
				$(this).val($.precise_round(parseFloat($(this).val()), 2));
				updateInvoiceTotal();
				// if($this.hasClass('discount'))
					// $this.val("- "+$this.val() );
			});
			$('body').on('keyup', '.lineTotal', function(e){
				var $this = $(this);
				if(keyupTimeout) clearTimeout(keyupTimeout);
				keyupTimeout = setTimeout(function(){
					// console.log('keyup executed');
					$this.val($.precise_round($this.val().replace(/[^\d.]/g, ''), 2));
					updateInvoiceTotal();
					// if($this.hasClass('discount'))
						// $this.val("- "+$this.val() );
				}, 3000);
			});

			$('body').on('click', '#newInvoiceLineItemBtn', function(e){

				e.preventDefault();
				lineItemCount++;

				// duplicate line item template
				var context = {};
				context.index = lineItemCount;
				context.is_menswear = $('#newInvoiceModal').attr('data-is-menswear');
				var template = Handlebars.templates['invoiceLineItem.html'](context);

				// append it to a table
				$(this).closest('tr').before(template);

				if(!context.is_menswear) {
					//initialize calendar to today's date
					$(this).closest('tr').prev('tr.lineItemRow').find('.lineItemDate').pikaday({
						minDate: new Date('1915-01-01'),
						maxDate: new Date('2020-12-31'),
						setDefaultDate: true,
						defaultDate: new Date(),
						yearRange: [1990,2025],
					});
				}

			});
			$('body').on('click', '.removeLineBtn', function(){
				$(this).closest('tr').remove();
				if($('.lineItemRow').length < 1){//if none left, add a new blank one
					lineItemCount++;
					var context = {};
					context.index = lineItemCount;
					context.is_menswear = $('#newInvoiceModal').attr('data-is-menswear');
					var template = Handlebars.templates['invoiceLineItem.html'](context);
					$('#newInvoiceForm .transactionTbl tbody').prepend(template);
					//initialize calendar to today's date
					$('#newInvoiceLineItemBtn').closest('tr').prev('tr.lineItemRow').find('.lineItemDate').pikaday({
						minDate: new Date('1915-01-01'),
						maxDate: new Date('2020-12-31'),
						setDefaultDate: true,
						defaultDate: new Date(),
						yearRange: [1990,2025],
					});
				}
				updateInvoiceTotal();
			});
			$("body").on('keyup', '.numericOnly', function() {
				var $this = $(this);
				$this.val($this.val().replace(/[^\d.]/g, ''));
			});

			function updateInvoiceTotal(){
				updateInvoiceDiscounts();
				var total = 0;
				$('#newInvoiceForm .transactionTbl .lineTotal:not(.discount)').each(function(){
					total += ($(this).val() == "") ? 0 : parseFloat($(this).val());
				});
				$('#newInvoiceForm .transactionTbl .lineTotal.discount').each(function(){
					if(!isNaN(parseFloat($(this).val().replace(/[^\d.]/g, ''))))
						total -= ($(this).val() == "") ? 0 : parseFloat($(this).val().replace(/[^\d.]/g, ''));
				});
				var invoiceTotal = $.precise_round(total, 2);
				$('#invoiceTotal').text(invoiceTotal);
				$('#invoiceTotal').attr('data-total', $.precise_round(total, 2));
			}

			function updateInvoiceSubTotal(){
				var total = 0;
				$('#newInvoiceForm .transactionTbl .lineTotal:not(.discount)').each(function(){
					total += ($(this).val() == "") ? 0 : parseFloat($(this).val().replace(/[^\d.]/g, ''));
				});
				return $.precise_round(total, 2);
			}

			function updateInvoiceDiscounts(){
				var subTotal = updateInvoiceSubTotal();
				$('#newInvoiceForm .transactionTbl .lineTotal.discount').each(function(){
					var $this = $(this);
					var type = $this.closest('tr').find('.discountType:checked').val();
					var $fieldToCheck = (type=='amount') ? $this : $this.closest('tr').find('.percentDiscount');

					//skip zero, invalid, or blank entries
					if(isNaN(parseFloat($fieldToCheck.val().replace(/[^\d.]/g, '')))) return true;
					if($fieldToCheck.val() == '') return true;
					if(parseFloat($fieldToCheck.val().replace(/[^\d.]/g, ''))==0) return true;

					var value = parseFloat($fieldToCheck.val().replace(/[^\d.]/g, ''));
					if(type=='percent'){
						var total = subTotal * (value / 100);
						$this.closest('tr').find('.lineTotal').val("- "+$.precise_round(total, 2));
					} else if(type=='amount'){
						$fieldToCheck.val("- "+$.precise_round(value, 2));
					}
				});
			}




    /************************/
    /*** Navigation Stuff ***/
    /************************/

			$("#mainBackButton").on('click', function(e){
				$("#clientPageBtn").trigger('click');
			});


			$("#catalogPageBtn").on('click', function(e){
				e.preventDefault();
				$('#mainMenuBar').show();
				$('#mainBackButton').hide();
				$('.topNavBtn').removeClass('active');
				$('#catalogPageBtn').addClass('active');
				$('#loadingPane, #clientDetailsPane, #earningsPane, #invoicesPane, #menswearPane').hide();
				$('#clientListPane').fadeOut('fast', function(){
					if(tableInitialized) clientDataTable.state.clear();
					$('#catalogListPane').fadeIn('fast');
				});
			});

			$("#clientPageBtn").on('click', function(e){
				e.preventDefault();
				$('#mainMenuBar').show();
				$('#mainBackButton').hide();
				$('.topNavBtn').removeClass('active');
				$('#clientPageBtn').addClass('active');
				$('#loadingPane, #clientDetailsPane, #earningsPane, #invoicesPane, #menswearPane').hide();
				$('#catalogListPane').fadeOut('fast', function(){
					$('#clientListPane').fadeIn('fast');
				});
			});

			$("#earningsPageBtn").on('click', function(e){
				e.preventDefault();
				$('#mainMenuBar').show();
				$('#mainBackButton').hide();
				$('.topNavBtn').removeClass('active');
				$('#earningsPageBtn').addClass('active');
				$('#loadingPane, #clientDetailsPane, #clientListPane, #catalogListPane, #invoicesPane, #menswearPane').hide();
				$('#earningsPane').fadeIn('slow', function(){
					renderCommissionChart('day');
				});
			});

			$("#invoicesPageBtn").on('click', function(e){
				e.preventDefault();
				$('#mainMenuBar').show();
				$('#mainBackButton').hide();
				$('.topNavBtn').removeClass('active');
				$('#invoicesPageBtn').addClass('active');
				$('#loadingPane, #clientDetailsPane, #clientListPane, #catalogListPane, #earningsPane, #menswearPane').hide();
				$('#invoicesPane').fadeIn('slow', function(){
					// renderCommissionChart();
				});
			});

			$("#menswearPageBtn").on('click', function(e){
				e.preventDefault();
				$('#mainMenuBar').hide();
				$('#mainBackButton').show();
				$('.topNavBtn').removeClass('active');
				$('#menswearPageBtn').addClass('active');
				$('#loadingPane, #clientDetailsPane, #clientListPane, #catalogListPane, #earningsPane, #invoicesPane').hide();
				$('#menswearPane').fadeIn('slow', function(){
					// renderCommissionChart();
				});
			});

			//initialize notifications on nav buttons
			if(1 > 0)
				$("#clientPageBtn .notification").removeClass('hidden').text('1');
			if(0 > 0)
				$("#catalogPageBtn .notification").removeClass('hidden').text('0');






			/**************************/
			/*  HighCharts Commission */
			/**************************/

			var commissionData = {
				month:[{
					name:"Monthly Earnings",
					data: [
													[1412143200000, 32.54],
														[1422774000000, 0.68],
														[1425193200000, 1.24],
														[1427868000000, 0.42],
														[1430460000000, 15.99],
														[1448953200000, 5.63],
														[1462082400000, 20.93],
														[1488351600000, 25.85],
														[1491026400000, 0],
														[1493618400000, 0],
														[1496296800000, 95.05],
														[1498888800000, 0],
														[1501567200000, 0],
														[1504245600000, 0],
														[1506837600000, 0],
														[1509516000000, 0],
														[1512111600000, 0],
														[1514790000000, 0.96],
												]
				}],
				week:[{
					name: "Weekly Earnings",
					data: [
													[1413180000000, 32.54],
														[1423465200000, 0.68],
														[1424674800000, 0.34],
														[1425880800000, 0.9],
														[1428904800000, 0.42],
														[1431928800000, 15.99],
														[1450076400000, 5.63],
														[1462168800000, 20.93],
														[1488178800000, 16.86],
														[1489989600000, 8.99],
														[1497247200000, 95.05],
														[1511161200000, 0],
														[1511766000000, 0],
														[1512370800000, 0],
														[1512975600000, 0],
														[1513580400000, 0],
														[1514185200000, 0],
														[1514790000000, 0.96],
														[1515394800000, 0],
														[1515999600000, 0],
														[1516604400000, 0],
														[1517209200000, 0],
														[1517814000000, 0],
														[1518418800000, 0],
												]
				}],
				day:[{
					name: "Daily Earnings",
					data: [
													[1413180000000, 32.54],
														[1423983600000, 0.68],
														[1425193200000, 0.34],
														[1426399200000, 0.9],
														[1428991200000, 0.42],
														[1432274400000, 15.99],
														[1450076400000, 5.63],
														[1462255200000, 20.93],
														[1488438000000, 16.86],
														[1490421600000, 8.99],
														[1497506400000, 95.05],
														[1515049200000, 0.96],
														[1516172400000, 0],
														[1516258800000, 0],
														[1516345200000, 0],
														[1516431600000, 0],
														[1516518000000, 0],
														[1516604400000, 0],
														[1516690800000, 0],
														[1516777200000, 0],
														[1516863600000, 0],
														[1516950000000, 0],
														[1517036400000, 0],
														[1517122800000, 0],
														[1517209200000, 0],
														[1517295600000, 0],
														[1517382000000, 0],
														[1517468400000, 0],
														[1517554800000, 0],
														[1517641200000, 0],
														[1517727600000, 0],
														[1517814000000, 0],
														[1517900400000, 0],
														[1517986800000, 0],
														[1518073200000, 0],
														[1518159600000, 0],
														[1518246000000, 0],
														[1518332400000, 0],
														[1518418800000, 0],
														[1518505200000, 0],
														[1518591600000, 0],
														[1518678000000, 0],
														[1518764400000, 0],
												]
				}],
				all:[{
					name: "Daily Earnings",
					data: [
													[1413093600000, 0],
														[1413180000000, 32.54],
														[1413266400000, 0],
														[1413352800000, 0],
														[1413439200000, 0],
														[1413525600000, 0],
														[1413612000000, 0],
														[1413698400000, 0],
														[1413784800000, 0],
														[1413871200000, 0],
														[1413957600000, 0],
														[1414044000000, 0],
														[1414130400000, 0],
														[1414216800000, 0],
														[1414303200000, 0],
														[1414389600000, 0],
														[1414476000000, 0],
														[1414562400000, 0],
														[1414648800000, 0],
														[1414735200000, 0],
														[1414821600000, 0],
														[1414908000000, 0],
														[1414998000000, 0],
														[1415084400000, 0],
														[1415170800000, 0],
														[1415257200000, 0],
														[1415343600000, 0],
														[1415430000000, 0],
														[1415516400000, 0],
														[1415602800000, 0],
														[1415689200000, 0],
														[1415775600000, 0],
														[1415862000000, 0],
														[1415948400000, 0],
														[1416034800000, 0],
														[1416121200000, 0],
														[1416207600000, 0],
														[1416294000000, 0],
														[1416380400000, 0],
														[1416466800000, 0],
														[1416553200000, 0],
														[1416639600000, 0],
														[1416726000000, 0],
														[1416812400000, 0],
														[1416898800000, 0],
														[1416985200000, 0],
														[1417071600000, 0],
														[1417158000000, 0],
														[1417244400000, 0],
														[1417330800000, 0],
														[1417417200000, 0],
														[1417503600000, 0],
														[1417590000000, 0],
														[1417676400000, 0],
														[1417762800000, 0],
														[1417849200000, 0],
														[1417935600000, 0],
														[1418022000000, 0],
														[1418108400000, 0],
														[1418194800000, 0],
														[1418281200000, 0],
														[1418367600000, 0],
														[1418454000000, 0],
														[1418540400000, 0],
														[1418626800000, 0],
														[1418713200000, 0],
														[1418799600000, 0],
														[1418886000000, 0],
														[1418972400000, 0],
														[1419058800000, 0],
														[1419145200000, 0],
														[1419231600000, 0],
														[1419318000000, 0],
														[1419404400000, 0],
														[1419490800000, 0],
														[1419577200000, 0],
														[1419663600000, 0],
														[1419750000000, 0],
														[1419836400000, 0],
														[1419922800000, 0],
														[1420009200000, 0],
														[1420095600000, 0],
														[1420182000000, 0],
														[1420268400000, 0],
														[1420354800000, 0],
														[1420441200000, 0],
														[1420527600000, 0],
														[1420614000000, 0],
														[1420700400000, 0],
														[1420786800000, 0],
														[1420873200000, 0],
														[1420959600000, 0],
														[1421046000000, 0],
														[1421132400000, 0],
														[1421218800000, 0],
														[1421305200000, 0],
														[1421391600000, 0],
														[1421478000000, 0],
														[1421564400000, 0],
														[1421650800000, 0],
														[1421737200000, 0],
														[1421823600000, 0],
														[1421910000000, 0],
														[1421996400000, 0],
														[1422082800000, 0],
														[1422169200000, 0],
														[1422255600000, 0],
														[1422342000000, 0],
														[1422428400000, 0],
														[1422514800000, 0],
														[1422601200000, 0],
														[1422687600000, 0],
														[1422774000000, 0],
														[1422860400000, 0],
														[1422946800000, 0],
														[1423033200000, 0],
														[1423119600000, 0],
														[1423206000000, 0],
														[1423292400000, 0],
														[1423378800000, 0],
														[1423465200000, 0],
														[1423551600000, 0],
														[1423638000000, 0],
														[1423724400000, 0],
														[1423810800000, 0],
														[1423897200000, 0],
														[1423983600000, 0.68],
														[1424070000000, 0],
														[1424156400000, 0],
														[1424242800000, 0],
														[1424329200000, 0],
														[1424415600000, 0],
														[1424502000000, 0],
														[1424588400000, 0],
														[1424674800000, 0],
														[1424761200000, 0],
														[1424847600000, 0],
														[1424934000000, 0],
														[1425020400000, 0],
														[1425106800000, 0],
														[1425193200000, 0.34],
														[1425279600000, 0],
														[1425366000000, 0],
														[1425452400000, 0],
														[1425538800000, 0],
														[1425625200000, 0],
														[1425711600000, 0],
														[1425798000000, 0],
														[1425880800000, 0],
														[1425967200000, 0],
														[1426053600000, 0],
														[1426140000000, 0],
														[1426226400000, 0],
														[1426312800000, 0],
														[1426399200000, 0.9],
														[1426485600000, 0],
														[1426572000000, 0],
														[1426658400000, 0],
														[1426744800000, 0],
														[1426831200000, 0],
														[1426917600000, 0],
														[1427004000000, 0],
														[1427090400000, 0],
														[1427176800000, 0],
														[1427263200000, 0],
														[1427349600000, 0],
														[1427436000000, 0],
														[1427522400000, 0],
														[1427608800000, 0],
														[1427695200000, 0],
														[1427781600000, 0],
														[1427868000000, 0],
														[1427954400000, 0],
														[1428040800000, 0],
														[1428127200000, 0],
														[1428213600000, 0],
														[1428300000000, 0],
														[1428386400000, 0],
														[1428472800000, 0],
														[1428559200000, 0],
														[1428645600000, 0],
														[1428732000000, 0],
														[1428818400000, 0],
														[1428904800000, 0],
														[1428991200000, 0.42],
														[1429077600000, 0],
														[1429164000000, 0],
														[1429250400000, 0],
														[1429336800000, 0],
														[1429423200000, 0],
														[1429509600000, 0],
														[1429596000000, 0],
														[1429682400000, 0],
														[1429768800000, 0],
														[1429855200000, 0],
														[1429941600000, 0],
														[1430028000000, 0],
														[1430114400000, 0],
														[1430200800000, 0],
														[1430287200000, 0],
														[1430373600000, 0],
														[1430460000000, 0],
														[1430546400000, 0],
														[1430632800000, 0],
														[1430719200000, 0],
														[1430805600000, 0],
														[1430892000000, 0],
														[1430978400000, 0],
														[1431064800000, 0],
														[1431151200000, 0],
														[1431237600000, 0],
														[1431324000000, 0],
														[1431410400000, 0],
														[1431496800000, 0],
														[1431583200000, 0],
														[1431669600000, 0],
														[1431756000000, 0],
														[1431842400000, 0],
														[1431928800000, 0],
														[1432015200000, 0],
														[1432101600000, 0],
														[1432188000000, 0],
														[1432274400000, 15.99],
														[1432360800000, 0],
														[1432447200000, 0],
														[1432533600000, 0],
														[1432620000000, 0],
														[1432706400000, 0],
														[1432792800000, 0],
														[1432879200000, 0],
														[1432965600000, 0],
														[1433052000000, 0],
														[1433138400000, 0],
														[1433224800000, 0],
														[1433311200000, 0],
														[1433397600000, 0],
														[1433484000000, 0],
														[1433570400000, 0],
														[1433656800000, 0],
														[1433743200000, 0],
														[1433829600000, 0],
														[1433916000000, 0],
														[1434002400000, 0],
														[1434088800000, 0],
														[1434175200000, 0],
														[1434261600000, 0],
														[1434348000000, 0],
														[1434434400000, 0],
														[1434520800000, 0],
														[1434607200000, 0],
														[1434693600000, 0],
														[1434780000000, 0],
														[1434866400000, 0],
														[1434952800000, 0],
														[1435039200000, 0],
														[1435125600000, 0],
														[1435212000000, 0],
														[1435298400000, 0],
														[1435384800000, 0],
														[1435471200000, 0],
														[1435557600000, 0],
														[1435644000000, 0],
														[1435730400000, 0],
														[1435816800000, 0],
														[1435903200000, 0],
														[1435989600000, 0],
														[1436076000000, 0],
														[1436162400000, 0],
														[1436248800000, 0],
														[1436335200000, 0],
														[1436421600000, 0],
														[1436508000000, 0],
														[1436594400000, 0],
														[1436680800000, 0],
														[1436767200000, 0],
														[1436853600000, 0],
														[1436940000000, 0],
														[1437026400000, 0],
														[1437112800000, 0],
														[1437199200000, 0],
														[1437285600000, 0],
														[1437372000000, 0],
														[1437458400000, 0],
														[1437544800000, 0],
														[1437631200000, 0],
														[1437717600000, 0],
														[1437804000000, 0],
														[1437890400000, 0],
														[1437976800000, 0],
														[1438063200000, 0],
														[1438149600000, 0],
														[1438236000000, 0],
														[1438322400000, 0],
														[1438408800000, 0],
														[1438495200000, 0],
														[1438581600000, 0],
														[1438668000000, 0],
														[1438754400000, 0],
														[1438840800000, 0],
														[1438927200000, 0],
														[1439013600000, 0],
														[1439100000000, 0],
														[1439186400000, 0],
														[1439272800000, 0],
														[1439359200000, 0],
														[1439445600000, 0],
														[1439532000000, 0],
														[1439618400000, 0],
														[1439704800000, 0],
														[1439791200000, 0],
														[1439877600000, 0],
														[1439964000000, 0],
														[1440050400000, 0],
														[1440136800000, 0],
														[1440223200000, 0],
														[1440309600000, 0],
														[1440396000000, 0],
														[1440482400000, 0],
														[1440568800000, 0],
														[1440655200000, 0],
														[1440741600000, 0],
														[1440828000000, 0],
														[1440914400000, 0],
														[1441000800000, 0],
														[1441087200000, 0],
														[1441173600000, 0],
														[1441260000000, 0],
														[1441346400000, 0],
														[1441432800000, 0],
														[1441519200000, 0],
														[1441605600000, 0],
														[1441692000000, 0],
														[1441778400000, 0],
														[1441864800000, 0],
														[1441951200000, 0],
														[1442037600000, 0],
														[1442124000000, 0],
														[1442210400000, 0],
														[1442296800000, 0],
														[1442383200000, 0],
														[1442469600000, 0],
														[1442556000000, 0],
														[1442642400000, 0],
														[1442728800000, 0],
														[1442815200000, 0],
														[1442901600000, 0],
														[1442988000000, 0],
														[1443074400000, 0],
														[1443160800000, 0],
														[1443247200000, 0],
														[1443333600000, 0],
														[1443420000000, 0],
														[1443506400000, 0],
														[1443592800000, 0],
														[1443679200000, 0],
														[1443765600000, 0],
														[1443852000000, 0],
														[1443938400000, 0],
														[1444024800000, 0],
														[1444111200000, 0],
														[1444197600000, 0],
														[1444284000000, 0],
														[1444370400000, 0],
														[1444456800000, 0],
														[1444543200000, 0],
														[1444629600000, 0],
														[1444716000000, 0],
														[1444802400000, 0],
														[1444888800000, 0],
														[1444975200000, 0],
														[1445061600000, 0],
														[1445148000000, 0],
														[1445234400000, 0],
														[1445320800000, 0],
														[1445407200000, 0],
														[1445493600000, 0],
														[1445580000000, 0],
														[1445666400000, 0],
														[1445752800000, 0],
														[1445839200000, 0],
														[1445925600000, 0],
														[1446012000000, 0],
														[1446098400000, 0],
														[1446184800000, 0],
														[1446271200000, 0],
														[1446357600000, 0],
														[1446447600000, 0],
														[1446534000000, 0],
														[1446620400000, 0],
														[1446706800000, 0],
														[1446793200000, 0],
														[1446879600000, 0],
														[1446966000000, 0],
														[1447052400000, 0],
														[1447138800000, 0],
														[1447225200000, 0],
														[1447311600000, 0],
														[1447398000000, 0],
														[1447484400000, 0],
														[1447570800000, 0],
														[1447657200000, 0],
														[1447743600000, 0],
														[1447830000000, 0],
														[1447916400000, 0],
														[1448002800000, 0],
														[1448089200000, 0],
														[1448175600000, 0],
														[1448262000000, 0],
														[1448348400000, 0],
														[1448434800000, 0],
														[1448521200000, 0],
														[1448607600000, 0],
														[1448694000000, 0],
														[1448780400000, 0],
														[1448866800000, 0],
														[1448953200000, 0],
														[1449039600000, 0],
														[1449126000000, 0],
														[1449212400000, 0],
														[1449298800000, 0],
														[1449385200000, 0],
														[1449471600000, 0],
														[1449558000000, 0],
														[1449644400000, 0],
														[1449730800000, 0],
														[1449817200000, 0],
														[1449903600000, 0],
														[1449990000000, 0],
														[1450076400000, 5.63],
														[1450162800000, 0],
														[1450249200000, 0],
														[1450335600000, 0],
														[1450422000000, 0],
														[1450508400000, 0],
														[1450594800000, 0],
														[1450681200000, 0],
														[1450767600000, 0],
														[1450854000000, 0],
														[1450940400000, 0],
														[1451026800000, 0],
														[1451113200000, 0],
														[1451199600000, 0],
														[1451286000000, 0],
														[1451372400000, 0],
														[1451458800000, 0],
														[1451545200000, 0],
														[1451631600000, 0],
														[1451718000000, 0],
														[1451804400000, 0],
														[1451890800000, 0],
														[1451977200000, 0],
														[1452063600000, 0],
														[1452150000000, 0],
														[1452236400000, 0],
														[1452322800000, 0],
														[1452409200000, 0],
														[1452495600000, 0],
														[1452582000000, 0],
														[1452668400000, 0],
														[1452754800000, 0],
														[1452841200000, 0],
														[1452927600000, 0],
														[1453014000000, 0],
														[1453100400000, 0],
														[1453186800000, 0],
														[1453273200000, 0],
														[1453359600000, 0],
														[1453446000000, 0],
														[1453532400000, 0],
														[1453618800000, 0],
														[1453705200000, 0],
														[1453791600000, 0],
														[1453878000000, 0],
														[1453964400000, 0],
														[1454050800000, 0],
														[1454137200000, 0],
														[1454223600000, 0],
														[1454310000000, 0],
														[1454396400000, 0],
														[1454482800000, 0],
														[1454569200000, 0],
														[1454655600000, 0],
														[1454742000000, 0],
														[1454828400000, 0],
														[1454914800000, 0],
														[1455001200000, 0],
														[1455087600000, 0],
														[1455174000000, 0],
														[1455260400000, 0],
														[1455346800000, 0],
														[1455433200000, 0],
														[1455519600000, 0],
														[1455606000000, 0],
														[1455692400000, 0],
														[1455778800000, 0],
														[1455865200000, 0],
														[1455951600000, 0],
														[1456038000000, 0],
														[1456124400000, 0],
														[1456210800000, 0],
														[1456297200000, 0],
														[1456383600000, 0],
														[1456470000000, 0],
														[1456556400000, 0],
														[1456642800000, 0],
														[1456729200000, 0],
														[1456815600000, 0],
														[1456902000000, 0],
														[1456988400000, 0],
														[1457074800000, 0],
														[1457161200000, 0],
														[1457247600000, 0],
														[1457334000000, 0],
														[1457420400000, 0],
														[1457506800000, 0],
														[1457593200000, 0],
														[1457679600000, 0],
														[1457766000000, 0],
														[1457852400000, 0],
														[1457935200000, 0],
														[1458021600000, 0],
														[1458108000000, 0],
														[1458194400000, 0],
														[1458280800000, 0],
														[1458367200000, 0],
														[1458453600000, 0],
														[1458540000000, 0],
														[1458626400000, 0],
														[1458712800000, 0],
														[1458799200000, 0],
														[1458885600000, 0],
														[1458972000000, 0],
														[1459058400000, 0],
														[1459144800000, 0],
														[1459231200000, 0],
														[1459317600000, 0],
														[1459404000000, 0],
														[1459490400000, 0],
														[1459576800000, 0],
														[1459663200000, 0],
														[1459749600000, 0],
														[1459836000000, 0],
														[1459922400000, 0],
														[1460008800000, 0],
														[1460095200000, 0],
														[1460181600000, 0],
														[1460268000000, 0],
														[1460354400000, 0],
														[1460440800000, 0],
														[1460527200000, 0],
														[1460613600000, 0],
														[1460700000000, 0],
														[1460786400000, 0],
														[1460872800000, 0],
														[1460959200000, 0],
														[1461045600000, 0],
														[1461132000000, 0],
														[1461218400000, 0],
														[1461304800000, 0],
														[1461391200000, 0],
														[1461477600000, 0],
														[1461564000000, 0],
														[1461650400000, 0],
														[1461736800000, 0],
														[1461823200000, 0],
														[1461909600000, 0],
														[1461996000000, 0],
														[1462082400000, 0],
														[1462168800000, 0],
														[1462255200000, 20.93],
														[1462341600000, 0],
														[1462428000000, 0],
														[1462514400000, 0],
														[1462600800000, 0],
														[1462687200000, 0],
														[1462773600000, 0],
														[1462860000000, 0],
														[1462946400000, 0],
														[1463032800000, 0],
														[1463119200000, 0],
														[1463205600000, 0],
														[1463292000000, 0],
														[1463378400000, 0],
														[1463464800000, 0],
														[1463551200000, 0],
														[1463637600000, 0],
														[1463724000000, 0],
														[1463810400000, 0],
														[1463896800000, 0],
														[1463983200000, 0],
														[1464069600000, 0],
														[1464156000000, 0],
														[1464242400000, 0],
														[1464328800000, 0],
														[1464415200000, 0],
														[1464501600000, 0],
														[1464588000000, 0],
														[1464674400000, 0],
														[1464760800000, 0],
														[1464847200000, 0],
														[1464933600000, 0],
														[1465020000000, 0],
														[1465106400000, 0],
														[1465192800000, 0],
														[1465279200000, 0],
														[1465365600000, 0],
														[1465452000000, 0],
														[1465538400000, 0],
														[1465624800000, 0],
														[1465711200000, 0],
														[1465797600000, 0],
														[1465884000000, 0],
														[1465970400000, 0],
														[1466056800000, 0],
														[1466143200000, 0],
														[1466229600000, 0],
														[1466316000000, 0],
														[1466402400000, 0],
														[1466488800000, 0],
														[1466575200000, 0],
														[1466661600000, 0],
														[1466748000000, 0],
														[1466834400000, 0],
														[1466920800000, 0],
														[1467007200000, 0],
														[1467093600000, 0],
														[1467180000000, 0],
														[1467266400000, 0],
														[1467352800000, 0],
														[1467439200000, 0],
														[1467525600000, 0],
														[1467612000000, 0],
														[1467698400000, 0],
														[1467784800000, 0],
														[1467871200000, 0],
														[1467957600000, 0],
														[1468044000000, 0],
														[1468130400000, 0],
														[1468216800000, 0],
														[1468303200000, 0],
														[1468389600000, 0],
														[1468476000000, 0],
														[1468562400000, 0],
														[1468648800000, 0],
														[1468735200000, 0],
														[1468821600000, 0],
														[1468908000000, 0],
														[1468994400000, 0],
														[1469080800000, 0],
														[1469167200000, 0],
														[1469253600000, 0],
														[1469340000000, 0],
														[1469426400000, 0],
														[1469512800000, 0],
														[1469599200000, 0],
														[1469685600000, 0],
														[1469772000000, 0],
														[1469858400000, 0],
														[1469944800000, 0],
														[1470031200000, 0],
														[1470117600000, 0],
														[1470204000000, 0],
														[1470290400000, 0],
														[1470376800000, 0],
														[1470463200000, 0],
														[1470549600000, 0],
														[1470636000000, 0],
														[1470722400000, 0],
														[1470808800000, 0],
														[1470895200000, 0],
														[1470981600000, 0],
														[1471068000000, 0],
														[1471154400000, 0],
														[1471240800000, 0],
														[1471327200000, 0],
														[1471413600000, 0],
														[1471500000000, 0],
														[1471586400000, 0],
														[1471672800000, 0],
														[1471759200000, 0],
														[1471845600000, 0],
														[1471932000000, 0],
														[1472018400000, 0],
														[1472104800000, 0],
														[1472191200000, 0],
														[1472277600000, 0],
														[1472364000000, 0],
														[1472450400000, 0],
														[1472536800000, 0],
														[1472623200000, 0],
														[1472709600000, 0],
														[1472796000000, 0],
														[1472882400000, 0],
														[1472968800000, 0],
														[1473055200000, 0],
														[1473141600000, 0],
														[1473228000000, 0],
														[1473314400000, 0],
														[1473400800000, 0],
														[1473487200000, 0],
														[1473573600000, 0],
														[1473660000000, 0],
														[1473746400000, 0],
														[1473832800000, 0],
														[1473919200000, 0],
														[1474005600000, 0],
														[1474092000000, 0],
														[1474178400000, 0],
														[1474264800000, 0],
														[1474351200000, 0],
														[1474437600000, 0],
														[1474524000000, 0],
														[1474610400000, 0],
														[1474696800000, 0],
														[1474783200000, 0],
														[1474869600000, 0],
														[1474956000000, 0],
														[1475042400000, 0],
														[1475128800000, 0],
														[1475215200000, 0],
														[1475301600000, 0],
														[1475388000000, 0],
														[1475474400000, 0],
														[1475560800000, 0],
														[1475647200000, 0],
														[1475733600000, 0],
														[1475820000000, 0],
														[1475906400000, 0],
														[1475992800000, 0],
														[1476079200000, 0],
														[1476165600000, 0],
														[1476252000000, 0],
														[1476338400000, 0],
														[1476424800000, 0],
														[1476511200000, 0],
														[1476597600000, 0],
														[1476684000000, 0],
														[1476770400000, 0],
														[1476856800000, 0],
														[1476943200000, 0],
														[1477029600000, 0],
														[1477116000000, 0],
														[1477202400000, 0],
														[1477288800000, 0],
														[1477375200000, 0],
														[1477461600000, 0],
														[1477548000000, 0],
														[1477634400000, 0],
														[1477720800000, 0],
														[1477807200000, 0],
														[1477893600000, 0],
														[1477980000000, 0],
														[1478066400000, 0],
														[1478152800000, 0],
														[1478239200000, 0],
														[1478325600000, 0],
														[1478412000000, 0],
														[1478502000000, 0],
														[1478588400000, 0],
														[1478674800000, 0],
														[1478761200000, 0],
														[1478847600000, 0],
														[1478934000000, 0],
														[1479020400000, 0],
														[1479106800000, 0],
														[1479193200000, 0],
														[1479279600000, 0],
														[1479366000000, 0],
														[1479452400000, 0],
														[1479538800000, 0],
														[1479625200000, 0],
														[1479711600000, 0],
														[1479798000000, 0],
														[1479884400000, 0],
														[1479970800000, 0],
														[1480057200000, 0],
														[1480143600000, 0],
														[1480230000000, 0],
														[1480316400000, 0],
														[1480402800000, 0],
														[1480489200000, 0],
														[1480575600000, 0],
														[1480662000000, 0],
														[1480748400000, 0],
														[1480834800000, 0],
														[1480921200000, 0],
														[1481007600000, 0],
														[1481094000000, 0],
														[1481180400000, 0],
														[1481266800000, 0],
														[1481353200000, 0],
														[1481439600000, 0],
														[1481526000000, 0],
														[1481612400000, 0],
														[1481698800000, 0],
														[1481785200000, 0],
														[1481871600000, 0],
														[1481958000000, 0],
														[1482044400000, 0],
														[1482130800000, 0],
														[1482217200000, 0],
														[1482303600000, 0],
														[1482390000000, 0],
														[1482476400000, 0],
														[1482562800000, 0],
														[1482649200000, 0],
														[1482735600000, 0],
														[1482822000000, 0],
														[1482908400000, 0],
														[1482994800000, 0],
														[1483081200000, 0],
														[1483167600000, 0],
														[1483254000000, 0],
														[1483340400000, 0],
														[1483426800000, 0],
														[1483513200000, 0],
														[1483599600000, 0],
														[1483686000000, 0],
														[1483772400000, 0],
														[1483858800000, 0],
														[1483945200000, 0],
														[1484031600000, 0],
														[1484118000000, 0],
														[1484204400000, 0],
														[1484290800000, 0],
														[1484377200000, 0],
														[1484463600000, 0],
														[1484550000000, 0],
														[1484636400000, 0],
														[1484722800000, 0],
														[1484809200000, 0],
														[1484895600000, 0],
														[1484982000000, 0],
														[1485068400000, 0],
														[1485154800000, 0],
														[1485241200000, 0],
														[1485327600000, 0],
														[1485414000000, 0],
														[1485500400000, 0],
														[1485586800000, 0],
														[1485673200000, 0],
														[1485759600000, 0],
														[1485846000000, 0],
														[1485932400000, 0],
														[1486018800000, 0],
														[1486105200000, 0],
														[1486191600000, 0],
														[1486278000000, 0],
														[1486364400000, 0],
														[1486450800000, 0],
														[1486537200000, 0],
														[1486623600000, 0],
														[1486710000000, 0],
														[1486796400000, 0],
														[1486882800000, 0],
														[1486969200000, 0],
														[1487055600000, 0],
														[1487142000000, 0],
														[1487228400000, 0],
														[1487314800000, 0],
														[1487401200000, 0],
														[1487487600000, 0],
														[1487574000000, 0],
														[1487660400000, 0],
														[1487746800000, 0],
														[1487833200000, 0],
														[1487919600000, 0],
														[1488006000000, 0],
														[1488092400000, 0],
														[1488178800000, 0],
														[1488265200000, 0],
														[1488351600000, 0],
														[1488438000000, 16.86],
														[1488524400000, 0],
														[1488610800000, 0],
														[1488697200000, 0],
														[1488783600000, 0],
														[1488870000000, 0],
														[1488956400000, 0],
														[1489042800000, 0],
														[1489129200000, 0],
														[1489215600000, 0],
														[1489302000000, 0],
														[1489384800000, 0],
														[1489471200000, 0],
														[1489557600000, 0],
														[1489644000000, 0],
														[1489730400000, 0],
														[1489816800000, 0],
														[1489903200000, 0],
														[1489989600000, 0],
														[1490076000000, 0],
														[1490162400000, 0],
														[1490248800000, 0],
														[1490335200000, 0],
														[1490421600000, 8.99],
														[1490508000000, 0],
														[1490594400000, 0],
														[1490680800000, 0],
														[1490767200000, 0],
														[1490853600000, 0],
														[1490940000000, 0],
														[1491026400000, 0],
														[1491112800000, 0],
														[1491199200000, 0],
														[1491285600000, 0],
														[1491372000000, 0],
														[1491458400000, 0],
														[1491544800000, 0],
														[1491631200000, 0],
														[1491717600000, 0],
														[1491804000000, 0],
														[1491890400000, 0],
														[1491976800000, 0],
														[1492063200000, 0],
														[1492149600000, 0],
														[1492236000000, 0],
														[1492322400000, 0],
														[1492408800000, 0],
														[1492495200000, 0],
														[1492581600000, 0],
														[1492668000000, 0],
														[1492754400000, 0],
														[1492840800000, 0],
														[1492927200000, 0],
														[1493013600000, 0],
														[1493100000000, 0],
														[1493186400000, 0],
														[1493272800000, 0],
														[1493359200000, 0],
														[1493445600000, 0],
														[1493532000000, 0],
														[1493618400000, 0],
														[1493704800000, 0],
														[1493791200000, 0],
														[1493877600000, 0],
														[1493964000000, 0],
														[1494050400000, 0],
														[1494136800000, 0],
														[1494223200000, 0],
														[1494309600000, 0],
														[1494396000000, 0],
														[1494482400000, 0],
														[1494568800000, 0],
														[1494655200000, 0],
														[1494741600000, 0],
														[1494828000000, 0],
														[1494914400000, 0],
														[1495000800000, 0],
														[1495087200000, 0],
														[1495173600000, 0],
														[1495260000000, 0],
														[1495346400000, 0],
														[1495432800000, 0],
														[1495519200000, 0],
														[1495605600000, 0],
														[1495692000000, 0],
														[1495778400000, 0],
														[1495864800000, 0],
														[1495951200000, 0],
														[1496037600000, 0],
														[1496124000000, 0],
														[1496210400000, 0],
														[1496296800000, 0],
														[1496383200000, 0],
														[1496469600000, 0],
														[1496556000000, 0],
														[1496642400000, 0],
														[1496728800000, 0],
														[1496815200000, 0],
														[1496901600000, 0],
														[1496988000000, 0],
														[1497074400000, 0],
														[1497160800000, 0],
														[1497247200000, 0],
														[1497333600000, 0],
														[1497420000000, 0],
														[1497506400000, 95.05],
														[1497592800000, 0],
														[1497679200000, 0],
														[1497765600000, 0],
														[1497852000000, 0],
														[1497938400000, 0],
														[1498024800000, 0],
														[1498111200000, 0],
														[1498197600000, 0],
														[1498284000000, 0],
														[1498370400000, 0],
														[1498456800000, 0],
														[1498543200000, 0],
														[1498629600000, 0],
														[1498716000000, 0],
														[1498802400000, 0],
														[1498888800000, 0],
														[1498975200000, 0],
														[1499061600000, 0],
														[1499148000000, 0],
														[1499234400000, 0],
														[1499320800000, 0],
														[1499407200000, 0],
														[1499493600000, 0],
														[1499580000000, 0],
														[1499666400000, 0],
														[1499752800000, 0],
														[1499839200000, 0],
														[1499925600000, 0],
														[1500012000000, 0],
														[1500098400000, 0],
														[1500184800000, 0],
														[1500271200000, 0],
														[1500357600000, 0],
														[1500444000000, 0],
														[1500530400000, 0],
														[1500616800000, 0],
														[1500703200000, 0],
														[1500789600000, 0],
														[1500876000000, 0],
														[1500962400000, 0],
														[1501048800000, 0],
														[1501135200000, 0],
														[1501221600000, 0],
														[1501308000000, 0],
														[1501394400000, 0],
														[1501480800000, 0],
														[1501567200000, 0],
														[1501653600000, 0],
														[1501740000000, 0],
														[1501826400000, 0],
														[1501912800000, 0],
														[1501999200000, 0],
														[1502085600000, 0],
														[1502172000000, 0],
														[1502258400000, 0],
														[1502344800000, 0],
														[1502431200000, 0],
														[1502517600000, 0],
														[1502604000000, 0],
														[1502690400000, 0],
														[1502776800000, 0],
														[1502863200000, 0],
														[1502949600000, 0],
														[1503036000000, 0],
														[1503122400000, 0],
														[1503208800000, 0],
														[1503295200000, 0],
														[1503381600000, 0],
														[1503468000000, 0],
														[1503554400000, 0],
														[1503640800000, 0],
														[1503727200000, 0],
														[1503813600000, 0],
														[1503900000000, 0],
														[1503986400000, 0],
														[1504072800000, 0],
														[1504159200000, 0],
														[1504245600000, 0],
														[1504332000000, 0],
														[1504418400000, 0],
														[1504504800000, 0],
														[1504591200000, 0],
														[1504677600000, 0],
														[1504764000000, 0],
														[1504850400000, 0],
														[1504936800000, 0],
														[1505023200000, 0],
														[1505109600000, 0],
														[1505196000000, 0],
														[1505282400000, 0],
														[1505368800000, 0],
														[1505455200000, 0],
														[1505541600000, 0],
														[1505628000000, 0],
														[1505714400000, 0],
														[1505800800000, 0],
														[1505887200000, 0],
														[1505973600000, 0],
														[1506060000000, 0],
														[1506146400000, 0],
														[1506232800000, 0],
														[1506319200000, 0],
														[1506405600000, 0],
														[1506492000000, 0],
														[1506578400000, 0],
														[1506664800000, 0],
														[1506751200000, 0],
														[1506837600000, 0],
														[1506924000000, 0],
														[1507010400000, 0],
														[1507096800000, 0],
														[1507183200000, 0],
														[1507269600000, 0],
														[1507356000000, 0],
														[1507442400000, 0],
														[1507528800000, 0],
														[1507615200000, 0],
														[1507701600000, 0],
														[1507788000000, 0],
														[1507874400000, 0],
														[1507960800000, 0],
														[1508047200000, 0],
														[1508133600000, 0],
														[1508220000000, 0],
														[1508306400000, 0],
														[1508392800000, 0],
														[1508479200000, 0],
														[1508565600000, 0],
														[1508652000000, 0],
														[1508738400000, 0],
														[1508824800000, 0],
														[1508911200000, 0],
														[1508997600000, 0],
														[1509084000000, 0],
														[1509170400000, 0],
														[1509256800000, 0],
														[1509343200000, 0],
														[1509429600000, 0],
														[1509516000000, 0],
														[1509602400000, 0],
														[1509688800000, 0],
														[1509775200000, 0],
														[1509861600000, 0],
														[1509951600000, 0],
														[1510038000000, 0],
														[1510124400000, 0],
														[1510210800000, 0],
														[1510297200000, 0],
														[1510383600000, 0],
														[1510470000000, 0],
														[1510556400000, 0],
														[1510642800000, 0],
														[1510729200000, 0],
														[1510815600000, 0],
														[1510902000000, 0],
														[1510988400000, 0],
														[1511074800000, 0],
														[1511161200000, 0],
														[1511247600000, 0],
														[1511334000000, 0],
														[1511420400000, 0],
														[1511506800000, 0],
														[1511593200000, 0],
														[1511679600000, 0],
														[1511766000000, 0],
														[1511852400000, 0],
														[1511938800000, 0],
														[1512025200000, 0],
														[1512111600000, 0],
														[1512198000000, 0],
														[1512284400000, 0],
														[1512370800000, 0],
														[1512457200000, 0],
														[1512543600000, 0],
														[1512630000000, 0],
														[1512716400000, 0],
														[1512802800000, 0],
														[1512889200000, 0],
														[1512975600000, 0],
														[1513062000000, 0],
														[1513148400000, 0],
														[1513234800000, 0],
														[1513321200000, 0],
														[1513407600000, 0],
														[1513494000000, 0],
														[1513580400000, 0],
														[1513666800000, 0],
														[1513753200000, 0],
														[1513839600000, 0],
														[1513926000000, 0],
														[1514012400000, 0],
														[1514098800000, 0],
														[1514185200000, 0],
														[1514271600000, 0],
														[1514358000000, 0],
														[1514444400000, 0],
														[1514530800000, 0],
														[1514617200000, 0],
														[1514703600000, 0],
														[1514790000000, 0],
														[1514876400000, 0],
														[1514962800000, 0],
														[1515049200000, 0.96],
														[1515135600000, 0],
														[1515222000000, 0],
														[1515308400000, 0],
														[1515394800000, 0],
														[1515481200000, 0],
														[1515567600000, 0],
														[1515654000000, 0],
														[1515740400000, 0],
														[1515826800000, 0],
														[1515913200000, 0],
														[1515999600000, 0],
														[1516086000000, 0],
														[1516172400000, 0],
														[1516258800000, 0],
														[1516345200000, 0],
														[1516431600000, 0],
														[1516518000000, 0],
														[1516604400000, 0],
														[1516690800000, 0],
														[1516777200000, 0],
														[1516863600000, 0],
														[1516950000000, 0],
														[1517036400000, 0],
														[1517122800000, 0],
														[1517209200000, 0],
														[1517295600000, 0],
														[1517382000000, 0],
														[1517468400000, 0],
														[1517554800000, 0],
														[1517641200000, 0],
														[1517727600000, 0],
														[1517814000000, 0],
														[1517900400000, 0],
														[1517986800000, 0],
														[1518073200000, 0],
														[1518159600000, 0],
														[1518246000000, 0],
														[1518332400000, 0],
														[1518418800000, 0],
														[1518505200000, 0],
														[1518591600000, 0],
														[1518678000000, 0],
														[1518764400000, 0],
														[1518850800000, 0],
												]
				}]
			};

			function getMinChartDate(period){
				if(period=='day')
					return 1516204657000;
				if(period=='week')
					return 1511625457000;
				if(period=='month')
					return 1489762657000;
				// if(period=='all')
					//;
			}

			function renderCommissionChart(period){
				commissionChart = new Highcharts.Chart({
					"title": {
						"text": null
					},
					"legend": {
						"layout": "vertical",
							"style": {},
							"enabled": false
					},
					"xAxis": {
						// startOnTick:true,
						// endOnTick:true,
						"type": "datetime",
						tickInterval: 7 * 24 * 3600 * 1000 * ( (period=='all') ? 30 : 1 ),
						minorTickInterval: 7 * 24 * 3600 * 1000,
						min: getMinChartDate(period),
						max: 1518850800000,
						// "minTickInterval": 86400000,
						startOfWeek: 1,
						// max: 1519887600000,
						minorTickWidth: 1,
						// minorTickInterval: 24 * 3600 * 1000,
						minorGridLineColor: "#f3f3f3",
						// tickInterval: 7 * 24 * 3600 * 1000,
						labels: {
							format: (period=='month') ? '{value:%B}' : '{value:%b %e}',
							rotation: (period=='month') ? 45 : 0,
							style: {
								fontSize: '12px',
								padding: '2px 5px',
								backgroundColor: 'black',
								fontWeight: 'bold'
							}
						},
						// alternateGridColor: 'rgba(76, 60, 60, 0.03)'
					},
					"yAxis": [{
						"title": {
							"text": null
						},
						min:0,
						minRange : 6,
						labels: {
							style: {
								fontSize: 13,
								fontWeight: 'bold'
							},
							formatter: function () {
								return '$'+ this.value +''
							}
						},
						gridLineWidth: 1,
					},{
						"title": {
							"text": null
						},
						labels: {
							style: {
								fontSize: 13,
								fontWeight: 'bold'
							},
							formatter: function () {
								return '$'+ this.value +''
							}
						},
						linkedTo:0,
						opposite:true
					}],
					"tooltip": {
						"enabled": true,
						borderRadius: 0,
						formatter: function () {
							return '<span>'+Highcharts.dateFormat('%B %d, %Y', this.x)+'</span><br /><b>Earned: $' + this.y + '</b>';
						}
					},
					"credits": {
						"enabled": false
					},
					chart: {
						type: "line",
						borderRadius: 0,
						renderTo: "chartContainer",
						style: {
							fontFamily: 'sans-serif'
						},
						events: {
							redraw: function (e) {
								var chart = e.target;
								chart.xAxis[0].removePlotBand('locked-date-bar-band');
								chart.xAxis[0].removePlotBand('locked-date-band');
								var period = $('.graphRangeBtn.active').attr('data-unit')
								if(period=='day') return false;
																if(period=='all') return false;
																var minX = chart.axes[0].min;
								chart.xAxis[0].addPlotBand({
									id: 'locked-date-band',
									color: 'rgba(123, 123, 123, 0.08)',
									from: minX,
									to: 1513632657000,
									label: {
										text:"<div style='text-align:center;line-height:.5em;'><i class='fa fa-lock' style='margin:-5px 0px 0 2px;display:inline-block;'></i> Locked</div>",
										align:"right",
										useHTML: true,
										style: {
											paddingRight: "10px",
											paddingTop: "14px",
											fontFamily: "Medio",
											fontSize: "16px",
											color: "#999",
											textTransform: "uppercase"
										}
									},
								});
								chart.xAxis[0].addPlotBand({
									id: 'locked-date-bar-band',
									color: 'rgba(123, 123, 123, 0.8)',
									from: 1513612657000,
									to: (period=='month') ? 1513719057000 : 1513632657000,
									zIndex: 1,
								});
							}
						}
					},
					"subtitle": {},
					"colors": ["#4CC397", "#333333"],
					"series": [
						{
							"name": "Commission Earned",
							"id": 	'series-user-102',
							"data": commissionData[period][0].data,
							pointRange: 24 * 3600 * 1000 * ( (period=='week' ? 7 : (period=='month') ? 30 : 1)),
						}
					],
					"plotOptions": {
						"series": {
							"cursor": 'pointer',
							pointRange: 24 * 3600 * 1000,
						}
					}
				}, function(chart){
					// chart.redraw(); // done to trigger plotBand drawing
				});

			}

			$('.graphRangeBtn').click(function(){

				$('.graphRangeBtn').removeClass('active');
				$(this).addClass('active');
				var unit = $(this).attr('data-unit')
				// $('#chartContainer').find('.highcharts-stack-labels').empty();
				// commissionChart.yAxis[0].options.stackLabels.enabled = false;
				// commissionChart.redraw();
				// return;

				commissionChart.destroy();

				switch(unit) {
					case "day":
						renderCommissionChart('day');
						/*
						// commissionChart.xAxis.minorTickInterval = 24 * 3600 * 1000;
						// commissionChart.xAxis.majorTickInterval = 2 * 24 * 3600 * 1000;
						// commissionChart.xAxis[0].setExtremes( (1517846257000), (1518850800000) );
						commissionChart.series[0].update({
							// pointInterval: 7 * 24 * 3600 * 1000,
							pointRange: 24 * 3600 * 1000,
							data: commissionData[unit][0].data
						}, false);
						commissionChart.xAxis[0].setExtremes( (1516204657000), (1518850800000), false);
						commissionChart.xAxis[0].update({
							labels: { format: '{value:%b %e}' },
							minorTickInterval: 7 * 24 * 3600 * 1000,
							tickInterval: 7 * 24 * 3600 * 1000,
							minorTickWidth: 1,
						}, false);
						commissionChart.tooltip.options.formatter = function() { return '<span>'+Highcharts.dateFormat('%B %d, %Y', this.x)+'</span><br /><b>Earned: $' + this.y + '</b>'; }
						*/
						break;

					case "week":
						renderCommissionChart('week');
						/*
						// commissionChart.xAxis.minorTickInterval = 7 * 24 * 3600 * 1000;
						commissionChart.series[0].update({
							pointRange: 7 * 24 * 3600 * 1000,
							data: commissionData[unit][0].data
						}, false);
						commissionChart.xAxis[0].setExtremes( (1511625457000), (1518850800000), false);
						commissionChart.xAxis[0].update({
							labels: { format: '{value:%b %e}' },
							tickInterval: 7 * 24 * 3600 * 1000,
						}, false);
						commissionChart.tooltip.options.formatter = function() { return '<span>Week of '+Highcharts.dateFormat('%B %d, %Y', this.x)+'</span><br /><b>Earned: $' + this.y + '</b>'; }
						*/
						break;

					case "month":
						renderCommissionChart('month');
						/*
						// commissionChart.xAxis.minorTickInterval = 30 * 24 * 3600 * 1000;
						commissionChart.series[0].update({
							pointRange: 30 * 24 * 3600 * 1000,
							data: commissionData[unit][0].data
						}, false);
						commissionChart.xAxis[0].setExtremes( (1489762657000), (1518850800000), false);
						commissionChart.xAxis[0].update({
							labels: { format: '{value:%B}' },
							tickInterval: 7 * 24 * 3600 * 1000,
						}, false);
						commissionChart.tooltip.options.formatter = function() { return '<span>'+Highcharts.dateFormat('%B %Y', this.x)+'</span><br /><b>Earned: $' + this.y + '</b>'; }
						*/
						break;

					case "all":
						renderCommissionChart('all');
						/*
						// commissionChart.xAxis.minorTickInterval = 30 * 24 * 3600 * 1000;
						commissionChart.series[0].update({
							pointRange: 24 * 3600 * 1000,
							// tickInterval: 7 * 24 * 3600 * 1000,
							data: commissionData[unit][0].data
						}, false);
						commissionChart.xAxis[0].setExtremes( (), (1518850800000), false);
						commissionChart.xAxis[0].update({
							labels: { format: '{value:%b %e}' },
							tickInterval: 7 * 24 * 3600 * 1000,
						}, false);
						commissionChart.tooltip.options.formatter = function() { return '<span>'+Highcharts.dateFormat('%B %d, %Y', this.x)+'</span><br /><b>Earned: $' + this.y + '</b>'; }
						*/
						break;
				}

				// commissionChart.yAxis[0].options.stackLabels.enabled = true;
				// commissionChart.series[0].isDirty = true;
				// commissionChart.yAxis[0].isDirty = true;
				// commissionChart.xAxis[0].isDirty = true;
				commissionChart.redraw();
				// console.log('ending chart.xAxis[0]:');
				// console.log(commissionChart.xAxis[0]);
				// $(window).trigger('resize');

			});




			//TODO: From localstorage, load which pane to display
			$('#clientPageBtn').trigger('click');


			$('#newClientFormURL').on('focus', function () { $(this).select(); })
			$("#newClientFormURL").mouseup(function(e){ e.preventDefault(); });
			$('#newClientFormURL').on('blur', function(e){ $(this).val($(this).attr('data-link')); });


			/**************************/
			/*  New Client Form Stuff */
			/**************************/
			/*
			var newClientFormIsDirty = false;

			$('#clientFormModal').on('hidden.bs.modal', function (e) {
				$(this).find('.modal-dialog').css({
					position: 'static',
					maxWidth: '600px',
					left:'',
					top:'',
					right:'',
					bottom:'',
					margin:''
				});
				$('#newClientFormInfoWrap').show();
				$('body').css('width', '').css('overflow', '');
			})

			$('#newClientFormURL').on('focus', function () { $(this).select(); })
			$("#newClientFormURL").mouseup(function(e){ e.preventDefault(); });
			$('#newClientFormURL').on('blur', function(e){ $(this).val($(this).attr('data-link')); });


			$('#editNewClientFormsBtn').on('click', function(){

				var $this = $(this).closest('.modal-dialog');
				$this.addClass('open');
				// showModalBackground();

				bodyScrollPos = $(window).scrollTop();
				var offset = $this[0].getBoundingClientRect();

				// $('#lookCommentsModal').attr('data-look-id', $lookWrap.attr('data-look-id'));
				$('#newClientFormInfoWrap').fadeOut('fast');
				$this.css({
					position: 'absolute',
					left: offset.left,
					right: $(window).width() - (offset.left + $this.outerWidth()),
					top: offset.top,
					margin: 0,
					bottom: $(window).height() - (offset.top + $this.outerHeight()),
					// width: $this.outerWidth(),
					zIndex: 99999,
					maxWidth: 'initial',
					width:'initial'
				}).animate({
					opacity:1,
					left: 0, //($(window).width()/2 - 400),
					right:0, //($(window).width()/2 - 400),
					top:0,
					bottom:0,
					margin:'0 auto'
				},
				300,
				"easein",
				function(){
					$('body').css('width', $('body').css('width')).css('overflow', 'hidden');
					$this.css('box-shadow', '0px 0px 53px 33px rgba(0, 0, 0, 0.39)');

					//re-render New Client form from handlebars
					var context = newClientFormData;
					var template = Handlebars.templates['newClientForm.html'](context);
					newClientFormIsDirty = false;

					$('#newClientFormWrap').html(template);
					renderTooltips();
					$('#newClientFormWrap').fadeIn(100);
				});
			});


			$('body').on('change', '#newClientFormWrap textarea, #newClientFormWrap input', function(e){
				newClientFormIsDirty = true;
			});

			$('body').on('click', '#closeNewClientFormEditorBtn, #cancelNewClientFormEditorBtn', function(e){

				e.preventDefault();

				if(newClientFormIsDirty) {
					var ask = confirm("You have unsaved changes.  Are you sure you want to leave the form?");
					if(!ask) {
						return false;
					}
				}

				$editBtn = $('#editNewClientFormsBtn');

				bodyScrollPos = $(window).scrollTop();
				var modalOffset = $('#clientFormModal .modal-dialog')[0].getBoundingClientRect();
				var btnOffset = $editBtn[0].getBoundingClientRect();

				$('#newClientFormWrap').fadeOut('fast', function(){

					$('#clientFormModal .modal-dialog').css({
						position: 'static',
						left: 'initial',
						right: 'initial',
						top: 'initial',
						margin: '30px auto',
						bottom: 'initial',
						zIndex: 99999,
						maxWidth:'600px',
					}).removeClass('open');

					$('#newClientFormWrap').html('');

					$("html, body").animate({ scrollTop: 0 }, 0);

					$('#newClientFormInfoWrap').fadeIn();
				});

			});

			$('body').on('change', '.newClientFormSectionToggle', function(){
				if($(this).prop('checked'))
					$(this).closest('.newClientFormSection').addClass('included');
				else
					$(this).closest('.newClientFormSection').removeClass('included');
			});

			$(document).on('change', '.btn-file :file', function() {
				var input = $(this),
					numFiles = input.get(0).files ? input.get(0).files.length : 1,
					label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
				input.trigger('fileselect', [numFiles, label]);
			});
			$('.btn-file :file').on('fileselect', function(event, numFiles, label) {
				// console.log(numFiles);
				// console.log(label);
			});

			$('body').on('change', ".clientPhotoUpload", function(){
				$(this).closest('div').find('.photoPreviewWrap').slideDown();
				$.readURL(this, $(this).closest('div').find('.photoPreview'));
			});

			$('body').on('click', '#saveNewClientFormEditorBtn', function(e){

				$(this).addClass('disabled');

				// console.log($('#newClientDetailsForm .newClientFormSectionToggle:not(:checked)'));

				var hiddenSections = $('#newClientDetailsForm .newClientFormSectionToggle:not(:checked)').map(function() { return $(this).closest('.newClientFormSection').attr("data-form-section-name") }).get().join(',')
				$('#newClientFormHiddenSections').val(hiddenSections);

				$.ajax({
					url: '/NewClientForms/save.json',
					data: $('#newClientFormWelcomeText, #newClientFormThankYouText, #newClientFormHiddenSections').serialize(),
					type: "POST",
					success: function (response) {
						if(response.success == 1) { // validation of client email successful
							// console.log(response);

							newClientFormData = response.newClientFormData;
							//re-render New Client form from handlebars
							var context = newClientFormData;
							var template = Handlebars.templates['newClientForm.html'](context);

							// close modal
							newClientFormIsDirty = false;
							$('#closeNewClientFormEditorBtn').trigger('click');

							return true;
						} else {
							alert('Oops! There was an error saving your New Client Form.  Please check your internet connection and try again.');
							return false;
						}
					}
				});

			});
            */





			/************************/
			/** Client Table Stuff **/
			/************************/


			$('.table-list-search tr').hover(function() {
				$(this).find('a').toggleClass('full');
			});


			$('body').on('click', '.featureVisibility > a', function(e) {
				e.stopPropagation();
			});
			$('body').on('click', '.clientRow td', function() {
				var $this = $(this);
				if($this.closest('tr').hasClass('emptyRow')) return;

				// console.log('beginning of clientRow td .click()');
				// console.log(clientDataSource);

				if(clientDetailsDirty) {
					// console.log('it was dirty');
					window.clearTimeout(clientEditTimeout);
					saveClientDetails()
					// console.log('saved it.');
				}

				clientDataTable.state.save();

				var client_id = $this.closest('tr').attr('data-client-id');
				$('#clientDetailsPane').attr('data-client-id', $this.closest('tr').attr('data-client-id'));

				renderClientDetails(client_id)

			});

			$('body').on('click', '.catalogRow td', function() {
				var $this = $(this);
				if($this.closest('tr').hasClass('emptyRow')) return;
				var catalogLink = $this.closest('tr').find('a.btn').attr('href');
				window.location.href = catalogLink;

			});


			function initializeDataTable() {

				if(tableInitialized) { // if just refreshing table
					clientDataTable.draw();
				} else { // if initializing table the first time

					$.extend( $.fn.dataTable.ext.classes, {
						"sFilter": "dataTables_filter input-group"
					})
					clientDataTable = $('#clientTable').DataTable({
						"dom": '<"top"f>rt<"bottom"lp><"clear">',
						"aLengthMenu": [ 20, 50, 100, 200 ],
						bStateSave: false,
						"language": {
							"sSearchPlaceholder": "Search Client's Name or Location...",
							"sSearch": ""
						},
						// Disable sorting on the no-sort class
						"aoColumnDefs" : [ {
							"bSortable" : false,
							"aTargets" : [ "no-sort" ]
						} ],
						bAutoWidth: false,
						"order": [[ 4, "desc" ], [ 6, "desc" ]]
					});
					$('#clientTable_filter input').unwrap().removeClass('input-sm').after('<span class="input-group-btn"> <button type="submit" class="btn btn-ghost-dark full" style="padding: 10px 20px 5px;z-index:2;box-shadow: 0px 2px 1px 0px rgba(0, 0, 0, 0.4); border-radius: 0; border: none;"><i class="fa fa-search"></i></button> </span>');
					$('#clientTable_filter').appendTo('#clientControls');

					clientDataTable.on('page', function(){
						$("html, body").animate({ scrollTop: 0 }, 0);
					});

					tableInitialized = true;
				}
				updateSearchFilterLabel($('#clientTable_filter input')[0])
			}

			function initializeCatalogDataTable() {
				catalogDataTable = $('#catalogTable').DataTable({
					"dom": '<"top">rt<"bottom"p><"clear">',
					"aLengthMenu": [ 20, 50, 100, 200 ],
					bStateSave: false,
					"language": {
						"sSearchPlaceholder": "Search Client's Name or Location...",
						"sSearch": ""
					},
					// Disable sorting on the no-sort class
					"aoColumnDefs" : [ {
						"bSortable" : false,
						"aTargets" : [ "no-sort" ]
					} ],
					bAutoWidth: false,
					"order": [[ 4, "desc" ]],
				});

				catalogDataTable.on('page', function(){
					$("html, body").animate({ scrollTop: 0 }, 0);
				});

			}

			function initializeInvoiceDataTable() {
				if(invoiceTableInitialized) { // if just refreshing table
					invoiceDataTable.draw();
				} else { // if initializing table the first time

					$.extend( $.fn.dataTable.ext.classes, {
						"sFilter": "dataTables_filter input-group"
					})
					invoiceDataTable = $('#invoiceTable').DataTable({
						"order": [[ 4, "desc" ]],
						"dom": '<"top"f>rt<"bottom"lp><"clear">',
						"aLengthMenu": [ 20, 50, 100, 200 ],
						bStateSave: false,
						"language": {
							"sSearchPlaceholder": "Search Client's Name...",
							"sSearch": ""
						},
						// Disable sorting on the no-sort class
						"aoColumnDefs" : [
							{
								"bSortable" : false,
								"aTargets" : [ "no-sort" ]
							},
							{
								render: function (data, type, full, meta){
									if(type == "display"){
										if(!data) return data;
										var $data = $(data);
										var amount = $data.find('.invoiceTotal').text();
										$data.find('.invoiceTotal').text(Number(amount).toFixed(2));
										j = $data.find('.invoiceTotal').text().split(".");
										$data.find('.invoiceTotal').html(j[0] + "<sup style='font-size: 14px;top: -0.8em;letter-spacing: -1px;'>." + j[1] + "</sup>");
										return $data.prop('outerHTML');
									}
									return data;
								},
								"aTargets" : [ "invoiceTotalCol" ],
							}
						],
					});
					$('#invoiceTable_filter input').unwrap().removeClass('input-sm').after('<span class="input-group-btn"> <button type="submit" class="btn btn-ghost-dark full" style="padding:9px 20px 5px;z-index:2; border-radius: 0; border: none;"><i class="fa fa-search"></i></button> </span>');
					$('#invoiceTable_filter').appendTo('#invoiceControls');

					invoiceDataTable.on('page', function(){
						$("html, body").animate({ scrollTop: 0 }, 0);
					});

					invoiceTableInitialized = true;
				}
				updateInvoiceSearchFilterLabel($('#invoiceTable_filter input')[0])

			}


			$('#sortInvoicesBy').change( function () {

				switch ($(this).val()) {
					case "created_desc":
					  invoiceDataTable.order( [ [4,'desc'] ] ).draw();
					  break;

					case "created_asc":
					  invoiceDataTable.order( [ [4,'asc'] ] ).draw();
					  break;

					case "due_asc":
					  invoiceDataTable.order( [ [5,'asc'] ] ).draw();
					  break;

					case "due_desc":
					  invoiceDataTable.order( [ [5,'desc'] ] ).draw();
					  break;

					case "_none_":  // first option chosen, not associated with any column, do some default
					  invoiceDataTable.order( [ [0,'asc'] ] ).draw();
					  break;

					case "name_asc":
					  invoiceDataTable.order( [ [0,'asc'] ] ).draw();
					  break;

					case "name_desc":
					  invoiceDataTable.order( [ [0,'desc'] ] ).draw();
					  break;

					case "price_asc":
					  invoiceDataTable.order( [ [1,'asc'] ] ).draw();
					  break;

					case "price_desc":
					  invoiceDataTable.order( [ [1,'desc'] ] ).draw();
					  break;

					case "first_name_asc":
					  invoiceDataTable.order( [ [2,'asc'] ] ).draw();
					  break;

					case "first_name_desc":
					  invoiceDataTable.order( [ [2,'desc'] ] ).draw();
					  break;
				}

			});


			function initializeOrderDataTable() {
				if(orderTableInitialized) { // if just refreshing table
					orderDataTable.draw();
				} else { // if initializing table the first time

					$.extend( $.fn.dataTable.ext.classes, {
						"sFilter": "dataTables_filter input-group"
					})
					orderDataTable = $('#orderTable').DataTable({
						"order": [[ 4, "desc" ]],
						"dom": '<"top"f>rt<"bottom"lp><"clear">',
						"aLengthMenu": [ 20, 50, 100, 200 ],
						bStateSave: false,
						"language": {
							"sSearchPlaceholder": "Search Client's Name...",
							"sSearch": ""
						},
						// Disable sorting on the no-sort class
						"aoColumnDefs" : [
							{
								"bSortable" : false,
								"aTargets" : [ "no-sort" ]
							},
							{
								render: function (data, type, full, meta){
									if(type == "display"){
										if(!data) return data;
										var $data = $(data);
										var amount = $data.find('.invoiceTotal').text();
										$data.find('.invoiceTotal').text(Number(amount).toFixed(2));
										j = $data.find('.invoiceTotal').text().split(".");
										$data.find('.invoiceTotal').html(j[0] + "<sup style='font-size: 14px;top: -0.8em;letter-spacing: -1px;'>." + j[1] + "</sup>");
										return $data.prop('outerHTML');
									}
									return data;
								},
								"aTargets" : [ "invoiceTotalCol" ],
							}
						],
					});
					$('#orderTable_filter input').unwrap().removeClass('input-sm').after('<span class="input-group-btn"> <button type="submit" class="btn btn-ghost-dark full" style="padding:9px 20px 5px;z-index:2; border-radius: 0; border: none;"><i class="fa fa-search"></i></button> </span>');
					$('#orderTable_filter').appendTo('#orderControls');

					orderDataTable.on('page', function(){
						$("html, body").animate({ scrollTop: 0 }, 0);
					});

					orderTableInitialized = true;
				}
				updateOrderSearchFilterLabel($('#orderTable_filter input')[0])

			}


			$('#sortOrdersBy').change( function () {

				switch ($(this).val()) {
					case "created_desc":
					  invoiceDataTable.order( [ [4,'desc'] ] ).draw();
					  break;

					case "created_asc":
					  invoiceDataTable.order( [ [4,'asc'] ] ).draw();
					  break;

					case "due_asc":
					  invoiceDataTable.order( [ [5,'asc'] ] ).draw();
					  break;

					case "due_desc":
					  invoiceDataTable.order( [ [5,'desc'] ] ).draw();
					  break;

					case "_none_":  // first option chosen, not associated with any column, do some default
					  invoiceDataTable.order( [ [0,'asc'] ] ).draw();
					  break;

					case "name_asc":
					  invoiceDataTable.order( [ [0,'asc'] ] ).draw();
					  break;

					case "name_desc":
					  invoiceDataTable.order( [ [0,'desc'] ] ).draw();
					  break;

					case "price_asc":
					  invoiceDataTable.order( [ [1,'asc'] ] ).draw();
					  break;

					case "price_desc":
					  invoiceDataTable.order( [ [1,'desc'] ] ).draw();
					  break;

					case "first_name_asc":
					  invoiceDataTable.order( [ [2,'asc'] ] ).draw();
					  break;

					case "first_name_desc":
					  invoiceDataTable.order( [ [2,'desc'] ] ).draw();
					  break;
				}

			});







			$('body').on('keyup', '#clientTable_filter input', function () {
				updateSearchFilterLabel(this);
			} );
			$('body').on('keyup', '#invoiceTable_filter input', function () {
				updateInvoiceSearchFilterLabel(this);
			} );

			function updateSearchFilterLabel(el){
				if(el.value.trim()=="") {
					$('#clearTableFilters').html('').hide();
				} else {
					if(!$('#clearTableFilters').is(':visible'))
						$('#clearTableFilters').css('display','inline-block');
					$('#clearTableFilters').html('Searching for "'+el.value+'" <button id="clearFiltersBtn" class="btn btn-xs btn-ghost"><i class="fa fa-times"></i> Clear</button>');
				}
			}
			function updateInvoiceSearchFilterLabel(el){
				if(el.value.trim()=="") {
					$('#clearInvoiceTableFilters').html('').hide();
				} else {
					if(!$('#clearInvoiceTableFilters').is(':visible'))
						$('#clearInvoiceTableFilters').css('display','inline-block');
					$('#clearInvoiceTableFilters').html('Searching for "'+el.value+'" <button id="clearInvoiceFiltersBtn" class="btn btn-xs btn-ghost-dark"><i class="fa fa-times"></i> Clear</button>');
				}
			}
			function updateOrderSearchFilterLabel(el){
				if(el.value.trim()=="") {
					$('#clearOrderTableFilters').html('').hide();
				} else {
					if(!$('#clearOrderTableFilters').is(':visible'))
						$('#clearOrderTableFilters').css('display','inline-block');
					$('#clearOrderTableFilters').html('Searching for "'+el.value+'" <button id="clearOrderFiltersBtn" class="btn btn-xs btn-ghost-dark"><i class="fa fa-times"></i> Clear</button>');
				}
			}
			$('body').on('click', '#clearFiltersBtn', function(){
				//this clears the datatable's search parameters
				clientDataTable
					.search( '' )
					.columns().search( '' )
					.draw();
				updateSearchFilterLabel($('#clientTable_filter input')[0]);
			});
			$('body').on('click', '#clearInvoiceFiltersBtn', function(){
				//this clears the datatable's search parameters
				invoiceDataTable
					.search( '' )
					.columns().search( '' )
					.draw();
				updateInvoiceSearchFilterLabel($('#invoiceTable_filter input')[0]);
			});
			$('body').on('click', '#clearOrderFiltersBtn', function(){
				//this clears the datatable's search parameters
				orderDataTable
					.search( '' )
					.columns().search( '' )
					.draw();
				updateOrderSearchFilterLabel($('#orderTable_filter input')[0]);
			});







    /********************************/
    /** Client Details Pane Stuff **/
    /********************************/

			function renderDatePickers() {
				var $datepicker = $('#followUpDatePicker').pikaday({
					minDate: new Date('1915-01-01'),
					maxDate: new Date('2020-12-31'),
					yearRange: [1915,2020],
				});
				var $datepicker = $('#ClientBirthday').pikaday({
					minDate: new Date('1915-01-01'),
					maxDate: new Date('2020-12-31'),
					yearRange: [1915,2020],
				});
				var $datepicker = $('#ClientAnniversary').pikaday({
					minDate: new Date('1915-01-01'),
					maxDate: new Date('2020-12-31'),
					yearRange: [1915,2020],
				});
			}

			$('body').on('click', '#followUpDateIcon', function(){
				$('#followUpDatePicker').pikaday('show')
			});

			$('body').on('click', '#showClientsListBtn', function(e) {
				$('#clientDetailsPane').fadeOut('fast', function(){
					clientDataTable.state.clear();
					$('#clientListPane').fadeIn('fast');
					clientDetailsDirty = false;
				});
			});

			$('body').on('click', '#clientPhoneDisplay', function(){
				$("html, body").animate({ scrollTop: $('#ClientPhone').offset().top - 100 }, 1000, function(){ $('#ClientPhone').focus(); });
			});

			$('body').on('click', '#clientEmailDisplay', function(){
				$("html, body").animate({ scrollTop: $('#ClientEmail').offset().top - 100 }, 1000, function(){ $('#ClientEmail').focus(); });
			});

			$('body').on('click', '#clientStreetAddressDisplay', function(){
				$("html, body").animate({ scrollTop: $('#ClientStreetAddress').offset().top - 100 }, 1000, function(){ $('#ClientStreetAddress').focus(); });
			});

			var clientEditTimeout;
			var clientDetailsDirty = false;
			var clientDetailsSaveIndex = 0;

			$('body').on('input propertychange change', '#clientDetailsForm :input, #clientDetailsPane textarea, #followUpDatePicker', function() {
				$form = $('#clientDetailsForm');
				clientDetailsDirty = true;
				clientDetailsSaveIndex++;
				$('#clientDetailsSaveIndex').val(clientDetailsSaveIndex);
				clearTimeout(clientEditTimeout);
				clientEditTimeout = window.setTimeout(saveClientDetails, 2000);
			});

			function saveClientDetails(){

                var form_id = $('#clientDetailsForm').attr('data-form-id');
                var form_instance_id = $('#clientDetailsForm').attr('data-form-instance-id');
                var client_id = $('#clientDetailsForm').attr('data-client-id');

                var formData = {};

				// for each form item
				$('#clientDetailsForm .formItem .field').each(function(){

					var $formItem = $(this).closest('.formItem');
					var type = $formItem.attr('data-type');
					var id = $formItem.attr('data-form-item-id');
					var fieldValue = "";

					// if(type == 5) { // if checkbox // not needed in client details pane
						// $formItem.find('.field').each(function(){
							// if(!$(this).prop('checked')) return true; // skip non-checked checkboxes
							// if(fieldValue != "") fieldValue += ", ";
							// fieldValue += $(this).val();
						// });
						// // serialize
					// } else {
						fieldValue = $(this).val();
					// }

					formData[id] = fieldValue;
					// store id:value pair

				});

				//console.log($('#clientDetailsForm :input, #clientDetailsPane textarea').serialize());
				$.ajax({
					url: '/clients/edit.json',
                    data: {
                        formData: formData,
                        formID : form_id,
                        formInstanceID : form_instance_id,
                        clientID: client_id,
                        follow_up_date: $('#followUpDatePicker').val(),
                        notes: $('#clientDetailsPane textarea').val(),
                        clientDetailsSaveIndex
                    }, //$('#clientDetailsForm :input, #clientDetailsPane textarea, #followUpDatePicker').serialize(),
					type: "POST",
					success: function (response) {
						if(response.success == 1) { // validation of client email successful
							console.log(response);

							clientDataSource[response.client_id] = response.clientInfo;
							renderClientListItem(response.client_id);

							if(clientDetailsDirty) {
								// if this is the latest update, mark clean
								if(response.clientDetailsSaveIndex == clientDetailsSaveIndex){
									clientDetailsDirty = false;
								}
								var context = clientDataSource[response.client_id];
								var template = Handlebars.templates['clientContactPane.html'](context); // your template minus the .js
								$("#clientContactPane").html(template);
							}
							// $form.find('input[name="data[Client][email]"]').parents('.form-group').removeClass('has-error')
							return true;
						} else {
							$form.find('input[name="data[Client][email]"]').parents('.form-group').addClass('has-error')
							// console.log(response);
							// $this.fadeTo(600, 1);
							// $('#addClientForm').before('<div id="clientErrorAlert" class="alert alert-danger animated shake">Please enter a valid email address</div>');
							return false;
						}
					}
				});
			}

			// Window event to show Confirm Notification
			window.onbeforeunload = confirmExit;
			function confirmExit() {
				if(clientDetailsDirty){
					return "Your changes need a few more seconds to finish saving.  (Ensure you have an active internet connection!)";
				}
			}

			setSliderTicks($( "#styleTypeSlider" ));

			function setSliderTicks(el){
				var $slider =  el;
				var max =  $slider.slider("option", "max");
				var spacing =  100 / (max);

				$slider.find('.ui-slider-tick-mark').remove();
				$slider.find('.ui-slider-base-line').remove();
				$('<span class="ui-slider-base-line"></span>').appendTo($slider);
				for (var i = 0; i < max ; i++) {
					$('<span class="ui-slider-tick-mark"></span>').css('left', (spacing * i) +  '%').appendTo($slider);
				}
				for (var i = 0; i < max ; i++) {
					if(i%10==0)
						$('<span class="ui-slider-tick-mark-large"></span>').css('left', (spacing * i) +  '%').appendTo($slider);
				}
				$('<span class="ui-slider-tick-mark-large"></span>').css('left', 100 +  '%').appendTo($slider);
			}








			/********************************/
			/** Client Profile Photo Stuff **/
			/********************************/

			$('body').on('click', '#clientProfilePicWrap .picLeftBtn, #clientProfilePicWrap .picRightBtn', function(){

				var direction = $(this).hasClass('picLeftBtn') ? 'prev' : 'next';
				var client_id = $("#clientDetailsPane").attr('data-client-id');

				var clientPhotos = clientDataSource[client_id].ClientsPhoto;

				var clientPhotosArray = new Array();
				$.each(clientPhotos, function(i, obj){
					clientPhotosArray[i] = obj.filename;
				});

				var currentIndex = clientPhotosArray.indexOf($('#clientProfilePic').attr('data-filename'));
				var newIndex = 0;

				newIndex = currentIndex + (direction=="prev" ? -1 : 1);

				if(newIndex >= clientPhotosArray.length)
					newIndex = 0;
				if(newIndex < 0)
					newIndex = clientPhotosArray.length - 1;

				$('#clientProfilePic').attr('src', '/img/clientPhotos/'+clientPhotosArray[(newIndex)]);
				$('#clientProfilePic').attr('data-filename', clientPhotosArray[(newIndex)]);

			});

			$('body').on('click', '#editProfilePicBtn', function(e){
				$btn = $(this);
				$this = $(this);

				showModalBackground();

				bodyScrollPos = $(window).scrollTop();
				var offset = $this[0].getBoundingClientRect();

				$('#photoUploadModal').addClass('open').show().css({
					left: offset.left,
					right: $(window).width() - (offset.left + $this.outerWidth()),
					top: offset.top,
					bottom: $(window).height() - (offset.top + $this.outerHeight()),
					// width: $this.outerWidth(),
					zIndex: 99999,
					maxWidth: '90%',
					// opacity:0,
					boxShadow: 'none',
					backgroundColor:$btn.css('backgroundColor'),
					overflow: 'hidden'
				}).animate({
					// opacity:1,
					left: 20, //($(window).width()/2 - 400),
					right:20, //($(window).width()/2 - 400),
					top:20,
					bottom:20,
					margin:'0 auto',
					boxShadow: '0px 0px 53px 33px rgba(0, 0, 0, 0.39)',
					backgroundColor:'#FFFFFF'
				},
				300,
				function(){

					var client_id = $("#clientDetailsPane").attr('data-client-id');
					var context = clientDataSource[client_id];
					var template = Handlebars.templates['clientPhotosGallery.html'](context); // your template minus the .js
					$("#clientPhotosGallery").html(template);

					$('body').css('width', $('body').css('width')).css('overflow', 'hidden');
					$('#photoUploadModal').css('overflow','auto');

					$('#photoUploadModalContent').fadeIn(100, function(){
						renderTooltips();
					});


					updateClientPhotoMainCropper(true);
				});

			});


			var imgUploadIndex = 0;
			var filesToUpload = 0;

			$("#fileUploadSelector, #takePhotoSelector").change(function(e){
				var $btn = $(this).closest('div').find('.btn')

				var element = $('#uploadPictureBtnWrap').hasClass('hidden') ? $("#takePhotoSelector")[0] : $("#fileUploadSelector")[0];
				filesToUpload = element.files;
				if(filesToUpload && filesToUpload.length > 0) {
					$('.photosToUpload').removeClass('hidden')
					// $('#photoUploadModalCopy').slideUp();
					$btn.addClass('disabled')
					$(this).prop('disabled', true);
					$btn.find('i').removeClass('fa-image').addClass('fa-cog fa-spin fa-fw');
					var success = handleFileSelect(this);
					if(!success)
						e.preventDefault();
					$('#addClientPhotosForm').submit();
				}
			});


			function handleFileSelect(input) {

				var files = input.files; // FileList object
				$('.photosToUpload').prepend('<li style="max-width:100%;width: 100%; border: none; height: auto; font-family: medio; font-size: 28px; text-transform: uppercase; color: #555;margin:0;"><p>Please wait...</p></li>');
				for (var i = 0, f; f = files[i]; i++) { // Loop through the FileList and render image files as thumbnails.
					if (!f.type.match('image.*')) {  continue; } // Only process image files.

					var reader = new FileReader();
					reader.onload = (function(theFile) { // Closure to capture the file information.
						return function(e) {
							// Render thumbnail.
							$('.photosToUpload').append('<li style="opacity:.3;"><img style="height:100%;max-width:100%;" src="'+e.target.result+'"  title="'+ escape(theFile.name) +'"/></li>');
						};
					})(f);

				  // Read in the image file as a data URL.
				  reader.readAsDataURL(f);
				}
			}

			function uploadHandler(e){ // useless for now...
				if(e.lengthComputable){
					$('progress').attr({value:e.loaded,max:e.total});
					// console.log({value:e.loaded,max:e.total});
				}
			}

			$('#addClientPhotosForm').on('submit', function(e){
				e.preventDefault();
				var element = $('#uploadPictureBtnWrap').hasClass('hidden') ? $("#takePhotoSelector")[0] : $("#fileUploadSelector")[0];
				filesToUpload = element.files;
				uploadNextImage();
				return false;
			});

			function uploadNextImage(){

				var client_id = $("#clientDetailsPane").attr('data-client-id');
				var data = new FormData();
				data.append('file_upload', filesToUpload[imgUploadIndex]);
				data.append('client_id', client_id);

				$.ajax({
					url: '/clientsPhotos/addPhoto.json',
					type: 'POST',
					data: data, 	// Form data
					xhr: function() {  // Custom XMLHttpRequest
						var myXhr = $.ajaxSettings.xhr();
						if(myXhr.upload){ // Check if upload property exists
							myXhr.upload.addEventListener('progress', uploadHandler, false); // For handling the progress of the upload
						}
						return myXhr;
					},
					error: function(response){
						imgUploadIndex++;
						// console.log('error:');
						// console.log(response);
					},
					cache: false, 	//Options to tell jQuery not to process data or worry about content-type.
					contentType: false,
					processData: false,
					// beforeSend: beforeSendHandler,
					success: function(response){
						// console.log(response);
						// console.log('response from index: '+imgUploadIndex+' / '+ filesToUpload.length);
						$('.photosToUpload li').eq(imgUploadIndex+1).css('opacity', 1);
						if(imgUploadIndex < filesToUpload.length - 1) {
							imgUploadIndex++;
							uploadNextImage();
						} else {
							//update all the things
							if(response.success) {

								// re-save client info

								// re-render 'main photo' cropping pane

								$("#clientPhotosGallery").html('');

								clientDataSource[response.client_id] = response.clientInfo;
								var context = clientDataSource[client_id];
								var template = Handlebars.templates['clientPhotosGallery.html'](context); // your template minus the .js
								$("#clientPhotosGallery").html(template);

								var template = Handlebars.templates['clientPhotoPane.html'](context); // your template minus the .js
								$("#clientPhotoPane").html(template);
								$('#clientProfilePic').css({ maxWidth: $('#clientPhotoPane').width(), width: 'auto', height: 'auto', maxHeight: $('#clientPhotoPane').height() });
								$('#clientPhotoPane table').css({ height: $('#clientPhotoPane').height() });

								renderTooltips();

								updateClientPhotoMainCropper(true);

								imgUploadIndex = 0;
								filesToUpload = null;
								$('#uploadPictureBtnWrap, #takePictureBtnWrap').find('.btn').removeClass('disabled')
								$('#uploadPictureBtnWrap, #takePictureBtnWrap').find('input').prop('disabled', false)
								$('#uploadPictureBtnWrap, #takePictureBtnWrap').find('.btn i').removeClass('fa-cog fa-spin fa-fw').addClass('fa-image');
							}
							return false;
						}
					}
				});

			}

			var $cropImage,
				$cropPreview,
				originalCropData = {};
			var cropOptions = {
					multiple: true,
					// data: originalCropData,
					minWidth: 300,
					minHeight: 300,
					zoomable: false,
					movable: false,
					dragCrop: false,
					// autoCropArea: 1,
					aspectRatio: 1/1,
					// preview: '#crop-preview',
					done: function(data) {
						// console.log(data);
					}
				};

			$('body').on('click touchstart', '#closephotoUploadModal', function(e){
				e.preventDefault();
				var $this = $(this);
				var $uploadBtn = $('#editProfilePicBtn')

				if($cropImage)
					$cropImage.cropper("destroy");

				$('#photoUploadModalContent').fadeOut('fast');
				$('#photoUploadModal').removeClass('open').css('overflow','hidden');;

				// $('#photoUploadModal').attr('data-look-id', '');
				$uploadBtn.removeClass('open');

				bodyScrollPos = $(window).scrollTop();
				var modalOffset = $('#photoUploadModal')[0].getBoundingClientRect();
				// console.log(modalOffset);
				var btnOffset = $uploadBtn[0].getBoundingClientRect();
				// console.log('btnOffset');
				// console.log($commentBtn);

				$('#photoUploadModal').show().css({
					left: modalOffset.left,
					right: $(window).width() - (modalOffset.left + $('#photoUploadModal').outerWidth()),
					top: modalOffset.top,
					bottom: $(window).height() - (modalOffset.top + $('#photoUploadModal').outerHeight()),
					// width: $this.outerWidth(),
					zIndex: 99999,
					boxShadow: '0px 0px 53px 33px rgba(0, 0, 0, 0.39)',
					backgroundColor:'#FFFFFF'
				}).animate({
					left: btnOffset.left,
					right: $(window).width() - (btnOffset.left + $uploadBtn.outerWidth()),
					top: btnOffset.top,
					bottom: $(window).height() - (btnOffset.top + $uploadBtn.outerHeight()),
					boxShadow: 'none',
					backgroundColor:$uploadBtn.css('backgroundColor')
				},
				300,
				function(){
					$('#photoUploadModal').hide();
					$('#photoUploadModalCopy').show();
					$('.photosToUpload').addClass('hidden')
					$('body').css({'width':'', 'overflow':'auto'});
					hideModalBackground();
				});

			});


			$('body').on('click', '#clientPhotoMainCropper .rotateImgLeftBtn', function(){
				rotateClientPhoto(90);
			});
			$('body').on('click', '#clientPhotoMainCropper .rotateImgRightBtn', function(){
				rotateClientPhoto(-90);
			});
			function rotateClientPhoto(degrees){
				$('#clientPhotoMainCropper .cropper-container').css('opacity', '.2');
				$.ajax({
					url: '/clientsPhotos/rotatePhoto.json',
					data: {
						data: {
							ClientsPhoto : {
								filename: $('#mainPhotoSelection').attr('data-filename')
							},
							degrees: degrees
						}
					},
					type: "POST",
					success: function (response) {
						var currentSrc = $cropImage.attr('src');
						$cropImage.attr('src', $.replaceUrlParam(currentSrc, "t", Date.now())) // append timestamp to image
						// var filenameWithParams = url.substr($cropImage.attr('src').lastIndexOf('/') + 1);
						// var filename = filenameWithParams.substr(0, filenameWithParams.lastIndexOf('?'));
						$('#clientPhotosWrap img[src*="'+ $cropImage.attr('data-filename') +'"]').each(function(){
							$(this).attr('src', $.replaceUrlParam(currentSrc, "t", Date.now())) // append timestamp to image
						});

						var $cropWrapper = $('#clientPhotoMainCropper .bootstrap-modal-cropper');
						$cropWrapper.attr('data-position-x', '');
						$cropWrapper.attr('data-position-y', '');
						$cropWrapper.attr('data-position-width', '');
						$cropWrapper.attr('data-position-height', '');

						updateClientPhotoMainCropper(false); // re-render cropper
					},
					error: function() {
						$('#clientPhotoMainCropper .cropper-container').css('opacity', '1');
					}
				});
			}

			$('body').on('click', '#clientPhotoMainCropper .picRightBtn, #clientPhotoMainCropper .picLeftBtn', function(){
				var direction = $(this).hasClass('picLeftBtn') ? 'prev' : 'next';
				var client_id = $("#clientDetailsPane").attr('data-client-id');

				var clientPhotos = clientDataSource[client_id].ClientsPhoto;

				var clientPhotosArray = new Array();
				$.each(clientPhotos, function(i, obj){
					clientPhotosArray[i] = obj.filename;
				});

				var currentIndex = clientPhotosArray.indexOf($('#mainPhotoSelection').attr('data-filename'));

				if(direction == 'next') {
					if(currentIndex >= clientPhotosArray.length - 1)
						currentIndex = -1;
					$('#mainPhotoSelection').attr('src', '/img/clientPhotos/'+clientPhotosArray[(currentIndex + 1)]);
					$('#mainPhotoSelection').attr('data-filename', clientPhotosArray[(currentIndex + 1)]);

					$('#clientPhotoMainCropper .bootstrap-modal-cropper').attr('data-is-primary', (currentIndex == -1 ? '1' : '0'));
				} else {
					if(currentIndex <= 0)
						currentIndex = clientPhotosArray.length;
					$('#mainPhotoSelection').attr('src', '/img/clientPhotos/'+clientPhotosArray[(currentIndex - 1)]);
					$('#mainPhotoSelection').attr('data-filename', clientPhotosArray[(currentIndex - 1)]);

					$('#clientPhotoMainCropper .bootstrap-modal-cropper').attr('data-is-primary', (currentIndex == 1 ? '1' : '0'));
				}

				updateClientPhotoMainCropper(false);
			});

			function updateClientPhotoMainCropper(render) {

				var client_id = $("#clientDetailsPane").attr('data-client-id');

				if(render) {
					var context = clientDataSource[client_id];
					var template = Handlebars.templates['clientPhotoMainCropper.html'](context); // your template minus the .js
					$("#clientPhotoMainCropper").html(template);
					$('#clientPhotoMainCropper .bootstrap-modal-cropper').attr('data-is-primary', '1');
				} else {
					var currentSrc = $cropImage.attr('src');
					$cropImage.cropper('destroy');
					$cropImage.attr('src', currentSrc);
				}

				if(clientDataSource[client_id].ClientsPhoto.length < 1) return;

				$cropImage = $('#mainPhotoSelection');
				var $cropWrapper = $('#clientPhotoMainCropper .bootstrap-modal-cropper');
				var imgData;
				var photoScale;

				$cropImage.load(function(){


					// var aspectRatio = parseInt($cropImage.width()) / parseInt($cropImage.height());

					// restrict tall photos to 300px high
					// if(aspectRatio < 1 && $cropImage.height() > 200) {
						// $cropWrapper.find('div').first().css({width: ((300/$cropImage.height())*$cropImage.width()), height: 300, margin: '0 auto'});
					// } else {
						// $cropWrapper.css({width: '100%', height: 'initial', margin: '0 auto'});
					// }

					var $cropInstance = $cropImage.cropper({
						multiple: true,
						zoomable: false,
						movable: false,
						dragCrop: false,
						minContainerWidth: 100,
						maxContainerWidth: '100%',
						responsive: true,
						aspectRatio: 1/1,
						autoCrop: true,
						built: function () {

							imgData = $cropImage.cropper('getImageData');
							photoScale = (imgData.width / imgData.naturalWidth);

							cropper = $cropInstance.data('cropper'), // Get the instance
							cropBox = cropper.cropBox; // Get the crop box object

							cropBox.minWidth = Math.min(Math.min(imgData.width, imgData.height), (300 * photoScale)); // Set a new minimum width
							cropBox.minHeight = Math.min(Math.min(imgData.width, imgData.height), (300 * photoScale)); // Set a new minimum width

							// handle offsets when image is constrained proportionally
							var wrapWidth = $('#clientPhotoMainCropper .cropper-container').width();
							var renderedWidth = $('#clientPhotoMainCropper .cropper-canvas').width();
							var wrapHeight = $('#clientPhotoMainCropper .cropper-container').height();
							var renderedHeight = $('#clientPhotoMainCropper .cropper-canvas').height();
							var leftOffset = (wrapWidth - renderedWidth) / 2;
							var topOffset = (wrapHeight - renderedHeight) / 2;

							// $cropWrapper.find('div').first().css({width: 'auto', height: 'auto'});
							$cropWrapper.find('.cropper-container').css({margin: '0 auto'});

							$cropImage.on('dragstart.cropper', function (e) {
								$cropWrapper.attr('data-is-dirty', '1');
							});

							if($cropWrapper.attr('data-is-primary')=='1') {
								var cropPositionData = {
									"left": 	parseInt($cropWrapper.attr('data-position-x')) * photoScale + leftOffset,
									"top":		parseInt($cropWrapper.attr('data-position-y')) * photoScale + topOffset,
									"width":	parseInt($cropWrapper.attr('data-position-width')) * photoScale,
									"height":	parseInt($cropWrapper.attr('data-position-height')) * photoScale
								};
								$cropImage.cropper('setCropBoxData', cropPositionData);
								$cropWrapper.attr('data-is-dirty', '0');
							}
							$('#clientPhotoMainCropper .cropper-container').css('opacity', '1');

						}
					});
				});
			}

			$('body').on('click', '#saveClientPhotoBtn', function(){
				var client_id = $("#clientDetailsPane").attr('data-client-id');
				var currentFilename = $('#mainPhotoSelection').attr('data-filename');
				var isDirty = $('#clientPhotoMainCropper .bootstrap-modal-cropper').attr('data-is-dirty') == '1';

				var saveCrop = false;
				var savePhoto = false;

				if(clientDataSource[client_id].ClientsPhoto.length){

					if(isDirty || clientDataSource[client_id].ClientsPhoto[0].filename != currentFilename){ //check if new photo, or the one that's already primary

						// get proportions for crop
						var cropData = $cropImage.cropper("getData")

						// POST crop data and filename
						$.ajax({
							url: '/clientsPhotos/savePrimaryImage.json',
							data: {
								data: {
									ClientsPhoto : {
										filename: currentFilename
									},
									cropData: cropData,
									client_id: client_id
								}
							},
							type: "POST",
							success: function (response) {

								// close the modal
								$('#closephotoUploadModal').click();

								// re-render images where necessary
								clientDataSource[client_id] = response.clientInfo;
								renderClientListItem(response.client_id);
								var context = clientDataSource[client_id];
								var template = Handlebars.templates['clientPhotoPane.html'](context); // your template minus the .js
								$("#clientPhotoPane").html(template);
								$('#clientProfilePic').css({ maxWidth: $('#clientPhotoPane').width(), width: 'auto', height:'auto', maxHeight: $('#clientPhotoPane').height() });
								$('#clientPhotoPane table').css({ height: $('#clientPhotoPane').height() });

							}
						});

					} else
						// close the modal
						$('#closephotoUploadModal').click();
				} else
					// close the modal
					$('#closephotoUploadModal').click();

			});

			$('body').on('click', '.deleteClientPhotoBtn', function(){

				var $li = $(this).closest('li');
				var clientsPhotoID = $li.find('img').attr('data-clients-photo-id');
				var clientID = $('#clientDetailsPane').attr('data-client-id');

				$li.css('opacity', .5);

				// post to delete() method
				$.ajax({
					url: '/clientsPhotos/delete.json',
					data: {
						data: {
							ClientsPhoto : {
								id: clientsPhotoID,
								client_id: clientID
							}
						}
					},
					type: "POST",
					success: function (response) {

						if(response.success){
							$li.fadeOut(function(){
								$li.remove();

								clientDataSource[clientID] = response.clientInfo;
								renderClientListItem(clientID);

								render = true;
								updateClientPhotoMainCropper(render);

								var context = clientDataSource[clientID];
								var template = Handlebars.templates['clientPhotoPane.html'](context); // your template minus the .js
								$("#clientPhotoPane").html(template);
								$('#clientProfilePic').css({ maxWidth: $('#clientPhotoPane').width(), width: 'auto', height:'auto', maxHeight: $('#clientPhotoPane').height() });
								$('#clientPhotoPane table').css({ height: $('#clientPhotoPane').height() });

								updateClientPhotoMainCropper(true);

								$('.tooltip.in').remove() // kill lingering tooltips
							});
						}

						// // re-render images where necessary
						// clientDataSource[client_id] = response.clientInfo;
						// var context = clientDataSource[client_id];
						// var template = Handlebars.templates['clientPhotoPane.html'](context); // your template minus the .js
						// $("#clientPhotoPane").html(template);

					},
					error: function() {
						$li.css('opacity', 1);
					}
				});
			});




			/********************************/
			/****** Client Colors Stuff *****/
			/********************************/

			$('body').on('click', '.personalColorBox', function(e){
				e.preventDefault();
				$this = $(this);
				var type = $this.attr('data-type');
				var $clientDetailsForm = $this.closest('form');
				$('#saveClientColorBtn').prop('disabled', true);

				if($this.attr('data-value')){ // already have selection, so re-highlight when opening the modal
					var colorVal = $this.attr('data-value');
					if(type=='skin' || type=='cheek') {
						$('#clientColorHelperDiv').css('background-color', $('.colorOption[data-'+type+'-color-id="'+colorVal+'"]').css('background-color'));
					} else if(type=='eye') {
						$('#clientColorHelperDiv').css('background-image', $('.colorOption[data-'+type+'-color-id="'+colorVal+'"]').css('background-image')).css('background-size', 'initial');
					} else {
						$('#clientColorHelperDiv').css('background-image', $('.colorOption[data-'+type+'-color-id="'+colorVal+'"]').css('background-image')).css('background-size', 'cover');
					}
					$('.colorOption[data-'+type+'-color-id="'+colorVal+'"]').addClass('selected');
					$('#saveClientColorBtn').prop('disabled', false);
				}

				showModalBackground();

				bodyScrollPos = $(window).scrollTop();
				var offset = $this[0].getBoundingClientRect();

				$('#clientColorModal').find('.colorChart').hide();
				$('#clientColorModal').find('#'+type+'ColorChart').show();
				$('#clientColorModal').find('#colorReferencePhoto').attr('src', $('#clientProfilePic').attr('src'))
				$('#colorReferencePhoto').closest('a').zoom({url: $('#clientProfilePic').attr('src')});
				$('#clientColorModal').find('h3').text('Client '+type+' Color');
				$('#clientColorModal').attr('data-client-id', $clientDetailsForm.attr('data-client-id'));
				$('#clientColorModal').attr('data-type', type);
				$('#clientColorModal').addClass('open').show().css({
					left: offset.left,
					right: $(window).width() - (offset.left + $this.outerWidth()),
					top: offset.top,
					bottom: $(window).height() - (offset.top + $this.outerHeight()),
					// width: $this.outerWidth(),
					zIndex: 99999,
					// maxWidth: '600px'
				}).animate({
					opacity:1,
					left: 20, //($(window).width()/2 - 400),
					right:20, //($(window).width()/2 - 400),
					top:20,
					bottom:20,
					margin:'0 auto'
				},
				300,
				function(){
					$('body').css('width', $('body').css('width')).css('overflow', 'hidden');
					$('#clientColorNav').show();
					$('#clientColorModal').css('box-shadow', '0px 0px 53px 33px rgba(0, 0, 0, 0.39)');
					var clientID = $clientDetailsForm.attr('data-client-id');
					// renderClientColors(lookID);
					// $('#clientColorModalContent').fadeIn(100);
				});

			});

			$('body').on('click touchstart', '#closeClientColorsModal', function(e){
				e.preventDefault();
				var $this = $(this);

				$('#clientColorHelperDiv').css('background-color', '');
				$('#clientColorHelperDiv').css('background-image', '');
				$('#clientColorNav').hide();

				$('#clientColorModal').removeClass('open').css('overflow','hidden');
				$btn = $('.personalColorBox[data-type="'+ $('#clientColorModal').attr('data-type') +'"]');

				bodyScrollPos = $(window).scrollTop();
				var modalOffset = $('#clientColorModal')[0].getBoundingClientRect();
				var btnOffset = $btn[0].getBoundingClientRect();

				$('#clientColorModal').show().css({
					left: modalOffset.left,
					right: $(window).width() - (modalOffset.left + $('#clientColorModal').outerWidth()),
					top: modalOffset.top,
					bottom: $(window).height() - (modalOffset.top + $('#clientColorModal').outerHeight()),
					// width: $this.outerWidth(),
					zIndex: 99999,
					boxShadow: '0px 0px 53px 33px rgba(0, 0, 0, 0.39)',
					backgroundColor:'#FFFFFF'
				}).animate({
					left: btnOffset.left,
					right: $(window).width() - (btnOffset.left + $btn.outerWidth()),
					top: btnOffset.top,
					bottom: $(window).height() - (btnOffset.top + $btn.outerHeight()),
					boxShadow: 'none',
					backgroundColor:$btn.css('backgroundColor')
				},
				300,
				function(){
					$('#clientColorModal').hide().css('overflow','auto');
					$('body').css({'width':'', 'overflow':'auto'});
					hideModalBackground();
				});
			});

			$('.colorOption').on('click', function(){
				$('#clientColorHelperDiv').css('background-image', '').css('background-color', '');
				if($(this).hasClass('selected')) {
					$('.colorOption').removeClass('selected');
					$('#saveClientColorBtn').prop('disabled', true);
				} else {
					$('.colorOption').removeClass('selected');
					$(this).addClass('selected');
					$('#saveClientColorBtn').prop('disabled', false);
				}
				var type = $('#clientColorModal').attr('data-type');
				if(type=='skin' || type=='cheek')
					$('#clientColorHelperDiv').css('background-color', $('.colorOption.selected').css('background-color'));
				else if(type=='eye')
					$('#clientColorHelperDiv').css('background-color', $('.colorOption.selected').attr('data-color')) //.css('background-size', 'initial');
				else
					$('#clientColorHelperDiv').css('background-image', $('.colorOption.selected').css('background-image')).css('background-size', 'cover');
			});

			$('#cancelClientColorBtn').on('click', function(){
				$('#closeClientColorsModal').trigger('click');
			});

			$('#saveClientColorBtn').on('click', function(){
				var type = $('#clientColorModal').attr('data-type');
				var valueID = $('.colorOption.selected').attr('data-'+type+'-color-id');
				var color = $('.colorOption.selected').attr('data-color');
				var complement = $('.colorOption.selected').attr('data-complement');
				$('.personalColorBox[data-type="'+type+'"]').addClass('selected');
				$('.personalColorBox[data-type="'+type+'"]').attr('data-value', valueID);
				$('.personalColorBox[data-type="'+type+'"]').attr('data-color', color);
				$('.personalColorBox[data-type="'+type+'"]').attr('data-complement', complement);
				if(type=='skin' || type=='cheek')
					$('.personalColorBox[data-type="'+type+'"]').css('background-color', $('.colorOption.selected').css('background-color'));
				else
					$('.personalColorBox[data-type="'+type+'"]').css('background-image', $('.colorOption.selected').css('background-image'));
				$('#closeClientColorsModal').trigger('click');
				$('#generatePersonalColorsBtn').prop('disabled', false).addClass('full');
			});

			// on pageload, if has client colors already...
			$('.personalColorBox').each(function(){
				if($(this).attr('data-value'))
					$('#generatePersonalColorsBtn').prop('disabled', false).addClass('full');
			});

			// on pageload, if clint colors already generated...
			if($('.colorSwatch').length)
				$('#generateComplementaryColorsBtn').prop('disabled', false).addClass('full');


			$('#generatePersonalColorsBtn').click(function(e){
				e.preventDefault();
				var $panel = $(this).closest('.panel-body')
				if($panel.find('.colorSwatch').length > 0) {
					var r = confirm("Are you sure you want to re-generate these colors?  All existing personal colors will be discarded.");
					if (r != true) return false;
				}
				$panel.find('.emptyColors').hide();
				$panel.find('.colorSwatch').remove();
				$('.personalColorBox').each(function(){
					if($(this).attr('data-value'))
						$panel.prepend("<div class='colorSwatch' data-color='"+$(this).attr('data-color')+"' data-complement='"+$(this).attr('data-complement')+"' style='background:"+$(this).attr('data-color')+"'></div>");
				});
				$('#generateComplementaryColorsBtn').prop('disabled', false).addClass('full');
			});
			$('#generateComplementaryColorsBtn').click(function(e){
				e.preventDefault();
				var $panel = $(this).closest('.panel-body')
				if($panel.find('.colorSwatch').length > 0) {
					var r = confirm("Are you sure you want to re-generate these colors?  All existing complementary colors will be discarded.");
					if (r != true) return false;
				}
				$panel.find('.emptyColors').hide();
				$panel.find('.colorSwatch').remove();
				$('#personalColors .colorSwatch').each(function(){
					var hex = $(this).attr('data-complement')
					$panel.prepend("<div class='colorSwatch' style='background:"+hex+"'></div>");

					// }
				});
			});

			$('.shapeOption').click(function(e){
				e.preventDefault();
				var $this = $(this);
				var $panel = $this.closest('.panel');
				if($this.hasClass('selected')){
					$this.removeClass('selected');
					$panel.addClass('noSelection');
				} else {
					$panel.find('.shapeOption').removeClass('selected');
					$panel.removeClass('noSelection');
					$this.addClass('selected');
				}
			});



			$('[data-toggle="tooltip"]').tooltip();

			$('.stickyClosetBtn').click(function(e){
				$this = $(this);
				e.stopPropagation();
				var $row = $this.closest("tr");
				var listType = $row.attr('class');
				if($this.hasClass("stickied")) {
					$this.toggleClass('stickied');
					$this.tooltip('destroy');
					$this.attr('title', 'Clip to top of list')
					$this.tooltip();

					if($('.stickyClosetBtn.stickied').length > 0) {
						$('#clientTable tr').eq($('.stickyClosetBtn.stickied:last').parents('tr').index()).after($row)
					}

				} else {
					$this.toggleClass('stickied');
					$this.tooltip('destroy');
					$this.attr('title', 'Un-clip from top of list')
					$this.tooltip();

					$row.prependTo($("#clientTable"))

				}
				saveClosetPositions(listType);
			});





			/********************************/
			/******* New Client Stuff *******/
			/********************************/

			var canadianStates = [{"value":"BC","Label":"British Columbia"},{"value":"ON","Label":"Ontario"},{"value":"NL","Label":"Newfoundland and Labrador"},{"value":"NS","Label":"Nova Scotia"},{"value":"PE","Label":"Prince Edward Island"},{"value":"NB","Label":"New Brunswick"},{"value":"QC","Label":"Quebec"},{"value":"MB","Label":"Manitoba"},{"value":"SK","Label":"Saskatchewan"},{"value":"AB","Label":"Alberta"},{"value":"NT","Label":"Northwest Territories"},{"value":"NU","Label":"Nunavut"},{"value":"YT","Label":"Yukon Territory"}];
			var USStates = [{"value":"AL","Label":"Alabama"},{"value":"AK","Label":"Alaska"},{"value":"AZ","Label":"Arizona"},{"value":"AR","Label":"Arkansas"},{"value":"CA","Label":"California"},{"value":"CO","Label":"Colorado"},{"value":"CT","Label":"Connecticut"},{"value":"DE","Label":"Delaware"},{"value":"DC","Label":"District Of Columbia"},{"value":"FL","Label":"Florida"},{"value":"GA","Label":"Georgia"},{"value":"HI","Label":"Hawaii"},{"value":"ID","Label":"Idaho"},{"value":"IL","Label":"Illinois"},{"value":"IN","Label":"Indiana"},{"value":"IA","Label":"Iowa"},{"value":"KS","Label":"Kansas"},{"value":"KY","Label":"Kentucky"},{"value":"LA","Label":"Louisiana"},{"value":"ME","Label":"Maine"},{"value":"MD","Label":"Maryland"},{"value":"MA","Label":"Massachusetts"},{"value":"MI","Label":"Michigan"},{"value":"MN","Label":"Minnesota"},{"value":"MS","Label":"Mississippi"},{"value":"MO","Label":"Missouri"},{"value":"MT","Label":"Montana"},{"value":"NE","Label":"Nebraska"},{"value":"NV","Label":"Nevada"},{"value":"NH","Label":"New Hampshire"},{"value":"NJ","Label":"New Jersey"},{"value":"NM","Label":"New Mexico"},{"value":"NY","Label":"New York"},{"value":"NC","Label":"North Carolina"},{"value":"ND","Label":"North Dakota"},{"value":"OH","Label":"Ohio"},{"value":"OK","Label":"Oklahoma"},{"value":"OR","Label":"Oregon"},{"value":"PA","Label":"Pennsylvania"},{"value":"RI","Label":"Rhode Island"},{"value":"SC","Label":"South Carolina"},{"value":"SD","Label":"South Dakota"},{"value":"TN","Label":"Tennessee"},{"value":"TX","Label":"Texas"},{"value":"UT","Label":"Utah"},{"value":"VT","Label":"Vermont"},{"value":"VA","Label":"Virginia"},{"value":"WA","Label":"Washington"},{"value":"WV","Label":"West Virginia"},{"value":"WI","Label":"Wisconsin"},{"value":"WY","Label":"Wyoming"}];

			$('.customCountryWrap').find('input, select').prop('disabled', true).removeAttr('required');
			$('.customStateWrap').find('input, select').prop('disabled', true).removeAttr('required');

			$("body").on('change', '#ClientCountry, .clientCountry', function() {
				$this = $(this)
				$form = $this.closest('form')
				if(typeof $(this).data('options') === "undefined"){
					$(this).data('options',$('#select2 option').clone());
				}
				var isCustomAlready = !($form.find('.customCountryWrap').hasClass('hidden'));

				$form.find('#ClientState option, .clientState option').remove();
				$form.find('.ddlCountryWrap').removeClass('hidden').find('input, select').prop('disabled', false).prop('required', true);
				$form.find('.ddlStateWrap').removeClass('hidden').find('input, select').prop('disabled', false).prop('required', true);
				$form.find('.customCountryWrap').addClass('hidden').find('input, select').prop('disabled', true).removeAttr('required');
				$form.find('.customStateWrap').addClass('hidden').find('input, select').prop('disabled', true).removeAttr('required');

				if(!isCustomAlready && $(this).val() == "CAN") {

					$(canadianStates).each(function() {
						 //this refers to the current item being iterated over
						 var option = $('<option value="'+this.value+'">'+this.Label+'</option>');
						 $form.find('#ClientState, .clientState').append(option);
					});
				} else if(!isCustomAlready && $(this).val() == "USA") {
					$(USStates).each(function() {
						 //this refers to the current item being iterated over
						 var option = $('<option value="'+this.value+'">'+this.Label+'</option>');
						 $form.find('#ClientState, .clientState').append(option);
					});
				} else {
					$form.find('.ddlCountryWrap').addClass('hidden').find('input, select').prop('disabled', true).removeAttr('required');
					$form.find('.ddlStateWrap').addClass('hidden').find('input, select').prop('disabled', true).removeAttr('required');
					$form.find('.customCountryWrap').removeClass('hidden').find('input, select').prop('disabled', false).prop('required', true);
					$form.find('.customStateWrap').removeClass('hidden').find('input, select').prop('disabled', false).prop('required', true);

					// $form.find('.customCountryWrap').removeClass('hidden').find('input').focus();
					// $form.find('.customStateWrap').removeClass('hidden');
					// $form.find('.clientState').addClass('hidden');
					// $(USStates).each(function() {
						// //this refers to the current item being iterated over
						// var option = $('<option value="'+this.value+'">'+this.Label+'</option>');
						// $form.find('#ClientState, .clientState').hide();
						// $form.find('#ClientState, .clientState.textbx').hide();
					// });
				}
			});


			$('#addClientBtn').click(function() {
				setupStates();
			});

			function setupStates() {
				$('#ClientCountry').val('USA'); //, .clientCountry
				$('#ClientState option').remove(); //, .clientState option
				$(USStates).each(function() {
					 var option = $('<option />');
					 option.attr('value', this.Value).text(this.Label);
					 // console.log(option);
					 $('#ClientState').append(option); //, .clientState
				});
			}

			$("#addClientForm").submit(function (e) {
				$this = $(this)
				$this.fadeTo(600, .6);

				$('#clientErrorAlert').remove();

				$.ajax({
					url: '/clients/ajaxValidation.json',
					data: $this.serialize(),
					type: "POST",
					async: false,
					success: function (response) {
						if(response.success == 1) { // go ahead and add the client
							return true;
						} else {
							e.preventDefault()
							$this.fadeTo(600, 1);
							$('#addClientForm').before('<div id="clientErrorAlert" class="alert alert-danger animated shake">Please enter a valid email address</div>');
							return false;
						}
					}
				});
			});






			/**************************/
			/***** Unused Methods *****/
			/**************************/


			$('.listTypeBtn').click(function(){
				$this = $(this);
				var type = $this.attr('data-type');
				$('#system-search').val('');
				$('.search-query-sf').remove();
				$('.search-sf').remove();
				$('tr.'+type).removeClass('hidden');
				if(!$this.hasClass('active')) {
					$this.addClass('active');
					$this.siblings('.listTypeBtn').removeClass('active');
					$('#clientTable tr').not('.'+type).fadeOut('fast', function(){
						$('#clientTable tr').not('.'+type).addClass('hidden');
						$('#clientTable tr.'+type).fadeIn('fast');
						$('#clientTable tr.'+type).removeClass('hidden');
					});
				}
			});

		});


</script>
<script type="text/javascript">

			$(document).ready(function(){

				// For Contact Modal
				$('#contactLink').click(function(e){
					e.preventDefault();
					$('#contactModal').modal('show');
				});

				$('#contactForm').submit(function(e){
					e.preventDefault();
					$this = $(this)
					$this.fadeTo(600, .6);

					$('#contactErrorAlert').remove();

					$.ajax({
						url: '/outsiders/contactForm.json',
						data: $this.serialize(),
						type: "POST",
						success: function (response) {
							$('#contactMessage').val('');
							if(response.success == 1) { // go ahead and add the client
								e.preventDefault()
								$this.fadeTo(600, 1);
								$('#contactForm').before('<div id="contactErrorAlert" class="alert alert-success">Your message was sent!</div>');
								return true;
							} else {
								e.preventDefault()
								$this.fadeTo(600, 1);
								$('#contactForm').before('<div id="contactErrorAlert" class="alert alert-danger animated shake">Oops! Unable to send message... Please email support@HueAndStripe.com!</div>');
								return false;
							}
						},
						error: function (response) {
							e.preventDefault()
							$this.fadeTo(600, 1);
							$('#contactForm').before('<div id="contactErrorAlert" class="alert alert-danger animated shake">Oops! Unable to send message... Please email support@HueAndStripe.com!</div>');
							return false;
						}
					});


				});

				// For iOS Apps
				if (("standalone" in window.navigator) && window.navigator.standalone) {
					$('a').on('click', function(e){
						e.preventDefault();
						var new_location = $(this).attr('href');
						if (new_location != undefined && new_location.substr(0, 1) != '#' && $(this).attr('data-method') == undefined){
							window.location = new_location;
						}
					});
				}
			});
			$(function() {
				FastClick.attach(document.body);
			});

</script>
<script src="/js/bootstrap.js"></script>

</body></html>
