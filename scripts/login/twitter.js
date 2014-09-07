var casper = require('casper').create({
    verbose: true,
    logLevel: 'error',
    stepTimeout: 180000,
    viewportSize:{width: 1024, height: 768}
});

casper.echo(casper.cli.has("user"));
casper.echo(casper.cli.has("pass"));


if(!(casper.cli.has("user") && casper.cli.get("pass"))){
	casper.echo("MSGTOPHP" + " ERROR~#" + "PARAMMISSING");
	casper.exit();
}

var username = casper.cli.get("user");
var password = casper.cli.get("pass");


casper.echo(username);
casper.echo(password);

casper.on("error", function(msg, trace) {
    this.echo("Error: " + msg, "ERROR");
});

casper.on("page.error", function(msg, trace) {
    this.echo("Error: " + msg, "ERROR");
});

casper.start('https://twitter.com/settings/password', function() {
    var currentUrl = this.getCurrentUrl();
    this.echo(this.getCurrentUrl()); 
    this.echo(this.getTitle()); 
    this.capture('/Applications/XAMPP/xamppfiles/htdocsonesettings/casperlog/twitter.png');
    if(currentUrl.search("/login") > 0){
        this.sendKeys('.signin-wrapper .js-username-field',username,{reset:true});
        this.evaluate(function(password){
        	document.querySelector(".signin-wrapper .js-password-field").value = password;
        },password);
        this.capture('/Applications/XAMPP/xamppfiles/htdocsonesettings/casperlog/twitter0.png');
    }
});

casper.wait(3000,function() {
	this.click('.signin-wrapper button[type="submit"]');
	this.capture('/Applications/XAMPP/xamppfiles/htdocsonesettings/casperlog/twitter1.png');
});


casper.wait(10000,function() {
    var currentUrl = this.getCurrentUrl();
    this.echo(this.getCurrentUrl()); 
    this.echo(this.getTitle()); 
    this.capture('/Applications/XAMPP/xamppfiles/htdocsonesettings/casperlog/twitter2.png');
    if(currentUrl.search("/login") > 0){
    	this.echo("MSGTOPHP" + " FAIL~#").exit();         
    }else if(currentUrl.search("/settings/password") > 0){
    	this.echo("MSGTOPHP" + " SUCCESS~#").exit();
    }else{
    	this.echo("MSGTOPHP" + " FAIL~#").exit();
    }
});

casper.run();