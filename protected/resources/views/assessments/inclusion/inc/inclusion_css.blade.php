<style>
input[type="text"],
input[type="email"],
input[type="date"],
select.form-control {
    height: 50px;
    margin: 0;
    padding: 0 20px;
    vertical-align: middle;
    background: #f8f8f8;
    font-family: 'Roboto', sans-serif;
    font-size: 16px;
    font-weight: 300;
    line-height: 50px;
    color: #888;
    -moz-border-radius: 4px;
    -webkit-border-radius: 4px;
    border-radius: 4px;
    -moz-box-shadow: none;
    -webkit-box-shadow: none;
    box-shadow: none;
    -o-transition: all .3s;
    -moz-transition: all .3s;
    -webkit-transition: all .3s;
    -ms-transition: all .3s;
    transition: all .3s;
}

input[type="file"] {
    height: 35px;
    margin: 0;
    padding: 0 20px;
    vertical-align: bottom;
    background: #f8f8f8;
   font-family: 'Roboto', sans-serif;
    font-size: 16px;
    font-weight: 300;
    line-height: 30px;
    color: #888;
    -moz-border-radius: 4px;
    -webkit-border-radius: 4px;
    border-radius: 4px;
    -moz-box-shadow: none;
    -webkit-box-shadow: none;
    box-shadow: none;
    -o-transition: all .3s;
    -moz-transition: all .3s;
    -webkit-transition: all .3s;
    -ms-transition: all .3s;
    transition: all .3s;
}

input[type=radio] {
    margin-top: 8px !important;
}

textarea,
textarea.form-control {
    padding-top: 10px;
    padding-bottom: 10px;
    line-height: 30px;
}

input[type="text"]:focus,
input[type="password"]:focus,
textarea:focus,
textarea.form-control:focus {
    outline: 0;
    background: #fff;
   
    -moz-box-shadow: none;
    -webkit-box-shadow: none;
    box-shadow: none;
}

input[type="text"]:-moz-placeholder,
input[type="password"]:-moz-placeholder,
textarea:-moz-placeholder,
textarea.form-control:-moz-placeholder {
    color: #888;
}

input[type="text"]:-ms-input-placeholder,
input[type="password"]:-ms-input-placeholder,
textarea:-ms-input-placeholder,
textarea.form-control:-ms-input-placeholder {
    color: #888;
}

input[type="text"]::-webkit-input-placeholder,
input[type="password"]::-webkit-input-placeholder,
textarea::-webkit-input-placeholder,
textarea.form-control::-webkit-input-placeholder {
    color: #888;
}

button.btn {
    height: 50px;
    margin: 0;
    padding: 0 20px;
    vertical-align: middle;
    background: #26A69A;
    ;
    border: 0;
    font-family: 'Roboto', sans-serif;
    font-size: 16px;
    font-weight: 300;
    line-height: 50px;
    color: #fff;
    -moz-border-radius: 4px;
    -webkit-border-radius: 4px;
    border-radius: 4px;
    text-shadow: none;
    -moz-box-shadow: none;
    -webkit-box-shadow: none;
    box-shadow: none;
    -o-transition: all .3s;
    -moz-transition: all .3s;
    -webkit-transition: all .3s;
    -ms-transition: all .3s;
    transition: all .3s;
}

button.btn:hover {
    opacity: 0.6;
    color: #fff;
}

button.btn:active {
    outline: 0;
    opacity: 0.6;
    color: #fff;
    -moz-box-shadow: none;
    -webkit-box-shadow: none;
    box-shadow: none;
}

button.btn:focus {
    outline: 0;
    opacity: 0.6;
    background: #26A69A;
    ;
    color: #fff;
}

button.btn:active:focus,
button.btn.active:focus {
    outline: 0;
    opacity: 0.6;
    background: #26A69A;
    ;
    color: #fff;
}


/*style.css**/

strong {
    font-weight: 500;
}

a,
a:hover,
a:focus {
    color: #26A69A;
    ;
    text-decoration: none;
    -o-transition: all .3s;
    -moz-transition: all .3s;
    -webkit-transition: all .3s;
    -ms-transition: all .3s;
    transition: all .3s;
}

h1,
h2 {
    margin-top: 10px;
    font-size: 38px;
    font-weight: 100;
    color: #555;
    line-height: 50px;
}

h3 {
    font-size: 22px;
    font-weight: 300;
    color: #555;
    line-height: 30px;
}

::-moz-selection {
    background: #26A69A;
    ;
    color: #fff;
    text-shadow: none;
}

::selection {
    background: #26A69A;
    ;
    color: #fff;
    text-shadow: none;
}

.btn-link-1 {
    display: inline-block;
    height: 50px;
    margin: 0 5px;
    padding: 16px 20px 0 20px;
    background: #26A69A;
    font-size: 16px;
    font-weight: 300;
    line-height: 16px;
    color: #fff;
    -moz-border-radius: 4px;
    -webkit-border-radius: 4px;
    border-radius: 4px;
}

.btn-link-1:hover,
.btn-link-1:focus,
.btn-link-1:active {
    outline: 0;
    opacity: 0.6;
    color: #fff;
}

.btn-link-2 {
    display: inline-block;
    height: 50px;
    margin: 0 5px;
    padding: 15px 20px 0 20px;
    background: rgba(0, 0, 0, 0.3);
    border: 1px solid #fff;
    font-size: 16px;
    font-weight: 300;
    line-height: 16px;
    color: #fff;
    -moz-border-radius: 4px;
    -webkit-border-radius: 4px;
    border-radius: 4px;
}

.btn-link-2:hover,
.btn-link-2:focus,
.btn-link-2:active,
.btn-link-2:active:focus {
    outline: 0;
    opacity: 0.6;
    background: rgba(0, 0, 0, 0.3);
    color: #fff;
}


/***** Top content *****/

.form-box {
    padding-top: 0px;
    font-family: 'Roboto', sans-serif !important;
}

.form-top {
    overflow: hidden;
    padding: 0 25px 15px 25px;
    background: #66BB6A;
    -moz-border-radius: 4px 4px 0 0;
    -webkit-border-radius: 4px 4px 0 0;
    border-radius: 4px 4px 0 0;
    text-align: left;
    color: #fff;
    transition: opacity .3s ease-in-out;
}
.col-md-3.table-client{
		border:1px solid  #66BB6A;
        padding: 10px;
 }
.table-title{
	font-weight: 700;	
	}

h1 .small,
.section-title,
.section-info{
	color: #fff;
	font-weight: 300;
	}
.section{
	width:40px;
	height:40px;
    font-size:20px;
    border: 1px solid #FFF;
    border-radius: 50%;
	padding: 5px;
}
.form-top h3 {
    color: #fff;
}
body {
    font-family: "Roboto", Helvetica Neue, Helvetica, Arial, sans-serif;
    font-size: 13px;
    line-height: 1.95384616;
    color: #333333;
    background-color: #eeeded;
}
.form-bottom {
    padding: 25px 25px 30px 25px;
      -moz-border-radius: 0 0 4px 4px;
    -webkit-border-radius: 0 0 4px 4px;
    border-radius: 0 0 4px 4px;
    text-align: left;
    transition: all .4s ease-in-out;
}
.rotate-vertically{
    transform: rotate(90deg);
	transform-origin: left top 0;
    float: inherit;
} 

    
.table > thead > tr > th, 
.table > tbody > tr > th, 
.table > tfoot > tr > th, 
.table > thead > tr > td, 
.table > tbody > tr > td, 
.table > tfoot > tr > td {
    padding: 8px;
    line-height: 1.5384616;
    vertical-align: top;
    border-top: 1px solid #ddd;
}
.form-bottom{
    -webkit-box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
    box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
}

form .form-bottom button.btn {
    min-width: 105px;
}

form .form-bottom .input-error {
    border-color: #d03e3e;
    color: #d03e3e;
}

form.registration-form fieldset {
    display: none;
}
</style> 