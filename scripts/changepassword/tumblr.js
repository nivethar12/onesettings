var casper = require('casper').create({
    verbose: true,
    logLevel: 'error',
    stepTimeout: 180000,
    viewportSize:{width: 1440, height: 900}
});

casper.echo(casper.cli.has("user"));
casper.echo(casper.cli.has("pass"));
casper.echo(casper.cli.has("newpass"));

if(!(casper.cli.has("user") && casper.cli.get("pass"))){
	casper.echo("MSGTOPHP" + " ERROR~#" + "PARAMMISSING");
	casper.exit();
}

var username = casper.cli.get("user");
var password = casper.cli.get("pass");
var newpassword = casper.cli.get("newpass");

casper.echo(username);
casper.echo(password);

casper.on("error", function(msg, trace) {
    this.echo("Error: " + msg, "ERROR");
});

casper.on("page.error", function(msg, trace) {
    this.echo("Error: " + msg, "ERROR");
});

var ENTER = String.fromCharCode(13);

casper.start('https://www.tumblr.com/settings/account', function() {
    var currentUrl = this.getCurrentUrl();
    this.echo(this.getCurrentUrl()); 
    this.echo(this.getTitle()); 
    this.capture('/Applications/XAMPP/xamppfiles/htdocsonesettings/casperlog/tumblrpass.png');
    if(currentUrl.search("/login") > 0){
        this.sendKeys('#signup_email', username,{reset:true});
        this.sendKeys('#signup_password', password,{reset:true});    
        this.click('#signup_forms_submit');
        this.capture('/Applications/XAMPP/xamppfiles/htdocsonesettings/casperlog/tumblrpass0.png');
    }    
});


casper.wait(15000,function() {
    var currentUrl = this.getCurrentUrl();
    this.echo(this.getCurrentUrl()); 
    this.echo(this.getTitle()); 
    this.capture('/Applications/XAMPP/xamppfiles/htdocsonesettings/casperlog/tumblrpass1.png');
    if(currentUrl.search("/login") > 0){
    	this.echo("MSGTOPHP" + " FAIL~#").exit();
    }else if(currentUrl.search("/settings/account") > 0){
    	this.click('.password_group .edit');
    	this.capture('/Applications/XAMPP/xamppfiles/htdocsonesettings/casperlog/tumblrpass2.png');
    }else{
    	this.echo("MSGTOPHP" + " FAIL~#").exit();
    }
});

casper.wait(5000,function() {
	this.capture('/Applications/XAMPP/xamppfiles/htdocsonesettings/casperlog/tumblrpass3.png');
	this.sendKeys('#password_current',password,true);
	this.sendKeys('#password_new',newpassword,true);
	this.sendKeys('#password_confirm',newpassword,true);
	this.click('.password_group .accordion_save',newpassword,true);
	
});

casper.wait(5000,function() {
	this.capture('/Applications/XAMPP/xamppfiles/htdocsonesettings/casperlog/tumblrpass4.png');
	this.echo("MSGTOPHP" + " SUCCESS~#").exit();
});

casper.run();