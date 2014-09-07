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

casper.start('https://www.tumblr.com/settings/account', function() {
    var currentUrl = this.getCurrentUrl();
    this.echo(this.getCurrentUrl()); 
    this.echo(this.getTitle()); 
    this.capture('/Applications/XAMPP/xamppfiles/htdocsonesettings/casperlog/tumblr.png');
    if(currentUrl.search("/login") > 0){
        this.sendKeys('#signup_email', username,{reset:true});
        this.sendKeys('#signup_password', password,{reset:true});    
        this.click('#signup_forms_submit');
        this.capture('/Applications/XAMPP/xamppfiles/htdocsonesettings/casperlog/tumblr0.png');
    }    
});


casper.wait(15000,function() {
    var currentUrl = this.getCurrentUrl();
    this.echo(this.getCurrentUrl()); 
    this.echo(this.getTitle()); 
    this.capture('/Applications/XAMPP/xamppfiles/htdocsonesettings/casperlog/tumblr1.png');
    if(currentUrl.search("/login") > 0){
    	this.echo("MSGTOPHP" + " FAIL~#").exit();
    }else if(currentUrl.search("/settings/account") > 0){
    	this.echo("MSGTOPHP" + " SUCCESS~#").exit();
    }else{
    	this.echo("MSGTOPHP" + " FAIL~#").exit();
    }
});

casper.run();