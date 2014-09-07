var casper = require('casper').create({
    verbose: true,
    logLevel: 'error',
    stepTimeout: 180000,
    viewportSize:{width: 1024, height: 768}
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

casper.start('https://www.dropbox.com/account', function() {
    var currentUrl = this.getCurrentUrl();
    this.echo(this.getCurrentUrl()); 
    this.echo(this.getTitle()); 
    this.capture('/Applications/XAMPP/xamppfiles/htdocsonesettings/casperlog/dropboxpass.png');
    if(currentUrl.search("/login") > 0){
        this.sendKeys('#login_email', username ,{reset:true});
        this.sendKeys('#login_password', password,{reset:true});    
        this.click('#login_submit');         
    }
});


casper.wait(15000,function() {
    var currentUrl = this.getCurrentUrl();
    this.echo(this.getCurrentUrl()); 
    this.echo(this.getTitle()); 
    this.capture('/Applications/XAMPP/xamppfiles/htdocsonesettings/casperlog/dropboxpass1.png');
    if(currentUrl.search("/login") > 0){
    	this.echo("MSGTOPHP" + " FAIL~#").exit();
    }else if (currentUrl.search("/account") > 0){
        this.click('.tabs div[data-hash="security"]'); 
        this.echo("SECURITY TAB LOADED");
        this.capture('/Applications/XAMPP/xamppfiles/htdocsonesettings/casperlog/dropboxpass2.png');
        this.click('.show-change-password');
        this.sendKeys('#oldpass', password,{reset:true});
        this.sendKeys('#newpass', newpassword,{reset:true});    
        this.click('#change-password input[type="submit"]');         
        this.capture('/Applications/XAMPP/xamppfiles/htdocsonesettings/casperlog/dropboxpass3.png');
    }    
    //this.capture('dropbox2.png');
});

casper.wait(10000,function() {
    this.capture('/Applications/XAMPP/xamppfiles/htdocsonesettings/casperlog/dropboxpass4.png');
    this.echo("MSGTOPHP" + " SUCCESS~#").exit();
});


casper.wait(10000,function() {
    this.capture('/Applications/XAMPP/xamppfiles/htdocsonesettings/casperlog/dropboxpass4.png');
    this.echo("MSGTOPHP" + " SUCCESS~#").exit();
});

casper.run();