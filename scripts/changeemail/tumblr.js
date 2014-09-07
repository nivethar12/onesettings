var casper = require('casper').create({
    verbose: true,
    logLevel: 'error',
    stepTimeout: 180000,
    viewportSize:{width: 1440, height: 900}
});

casper.echo(casper.cli.has("user"));
casper.echo(casper.cli.has("pass"));
casper.echo(casper.cli.has("newemail"));

if(!(casper.cli.has("user") && casper.cli.get("pass"))){
	casper.echo("MSGTOPHP" + " ERROR~#" + "PARAMMISSING");
	casper.exit();
}

var username = casper.cli.get("user");
var password = casper.cli.get("pass");
var newemail = casper.cli.get("newemail");

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
    this.capture('/Applications/XAMPP/xamppfiles/htdocsonesettings/casperlog/tumblremail.png');
    if(currentUrl.search("/login") > 0){
        this.sendKeys('#signup_email', username,{reset:true});
        this.sendKeys('#signup_password', password,{reset:true});    
        this.click('#signup_forms_submit');
        this.capture('/Applications/XAMPP/xamppfiles/htdocsonesettings/casperlog/tumblremail0.png');
    }    
});


casper.wait(15000,function() {
    var currentUrl = this.getCurrentUrl();
    this.echo(this.getCurrentUrl()); 
    this.echo(this.getTitle()); 
    this.capture('/Applications/XAMPP/xamppfiles/htdocsonesettings/casperlog/tumblremail1.png');
    if(currentUrl.search("/login") > 0){
    	this.echo("MSGTOPHP" + " FAIL~#").exit();
    }else if(currentUrl.search("/settings/account") > 0){
    	this.click('.email_group .edit');
    	this.capture('/Applications/XAMPP/xamppfiles/htdocsonesettings/casperlog/tumblremail2.png');
    }else{
    	this.echo("MSGTOPHP" + " FAIL~#").exit();
    }
});

casper.wait(5000,function() {
	this.capture('/Applications/XAMPP/xamppfiles/htdocsonesettings/casperlog/tumblremail3.png');
	this.sendKeys('#email_new',newemail,true);
	this.sendKeys('#email_password',password,true);
	this.click('.email_group .accordion_save',newemail,true);
});

casper.wait(5000,function() {
	this.capture('/Applications/XAMPP/xamppfiles/htdocsonesettings/casperlog/tumblrmail4.png');
	this.echo("MSGTOPHP" + " SUCCESS~#").exit();
});

casper.run();