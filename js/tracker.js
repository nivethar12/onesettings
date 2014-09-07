(function() {
	if(typeof folf != "undefined"){
		return false;
	}
	folf = {};
	folf.ref = (''+document.referrer+'');
	folf.topVal = 34;
	folf.rightVal = 6;
	folf.checkAtt = 0;
	
	folf.insertStyle =  function(cssStyles){
		var css = document.createElement("style");
		css.type = "text/css";
		css.innerHTML = cssStyles;
		document.body.appendChild(css);
	};

	folf.getOffset =  function(el) {
	    var _x = 0;
	    var _y = 0;
	    while( el && !isNaN( el.offsetLeft ) && !isNaN( el.offsetTop ) ) {
	        _x += el.offsetLeft - el.scrollLeft;
	        _y += el.offsetTop - el.scrollTop;
	        el = el.offsetParent;
	    }
	    return { top: _y, left: _x };
	};
	
	folf.addCredits =  function() {
		folf.insertStyle("a.btnfollfa{position:absolute;z-index:999999999999;white-space:nowrap;outline:0;text-decoration:none;cursor:pointer;overflow:hidden;font:600 12px/18px 'Helvetica Neue','HelveticaNeue',Helvetica,Arial,sans-serif;height:20px;padding:0 5px;-webkit-font-smoothing:antialiased;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;-ms-box-sizing:border-box;-o-box-sizing:border-box;box-sizing:border-box;-webkit-transition-property:padding;-moz-transition-property:padding;-ms-transition-property:padding;-o-transition-property:padding;transition-property:padding;-webkit-transition-duration:.1s;-moz-transition-duration:.1s;-ms-transition-duration:.1s;-o-transition-duration:.1s;transition-duration:.1s;-webkit-transition-timing-function:ease;-moz-transition-timing-function:ease;-ms-transition-timing-function:ease;-o-transition-timing-function:ease;transition-timing-function:ease}.btnfollfa{color:#fff;border:1px solid rgba(0,0,0,0.18);background:rgba(0,0,0,0.38);text-shadow:1px 1px 0 rgba(0,0,0,0.08)}a#btnfollfa,a#btnfollfa:hover{color:white!important}.btnfollfa{margin-bottom:5px;color:#fff;border:1px solid rgba(0,0,0,0.18);background:rgba(0,0,0,0.38);text-shadow:1px 1px 0 rgba(0,0,0,0.08);-webkit-border-radius:2px;-moz-border-radius:2px;border-radius:2px}.btnfollfa:hover::after,.btnfollfa:focus::after{background:rgba(255,255,255,0.09);color:white}.btnfollfa:active::after{background:rgba(255,255,255,0.18) color:white}.btn_label.show{display:block}.btnfollfa::after{position:absolute;top:0;right:0;bottom:0;left:0;content:'';-webkit-border-radius:inherit;-moz-border-radius:inherit;border-radius:inherit}.btnfollfa.icon::before{display:block;content:'';position:absolute;top:0;left:0;bottom:0;width:20px;border-radius:inherit;background:url('http://static.tumblr.com/tpqedpr/cQ1mbwb60/de.png') 0 0 no-repeat}.btnfollfa.theme::before{background-position:0 -0px}.btnfollfa img{width:15px;vertical-align: middle;}.btnfollfa.icon{padding-left:20px}.btnfollfa:active::after {background:rgba(255,255,255,0.18)}.clear {clear: both;} #pagination {display: all;}");
		var btnfollfa = document.createElement("a");
		btnfollfa.id="btnfollfa";
		btnfollfa.className="btnfollfa";
		btnfollfa.style.float="right";
		btnfollfa.style.position="fixed";
		btnfollfa.style.display="none";
		btnfollfa.title="Followers Factory";
		btnfollfa.href="http://followersfactory.com";
		btnfollfa.innerHTML = " <img src='http://t.followersfactory.com/sparkwhite.png'> Promote Ur Blog";
		document.body.appendChild(btnfollfa);		
	}
	
	folf.rearrangeCredits =  function() {
		var offset = folf.getOffset(document.getElementById("tumblr_controls"));
		if(offset.top == 0 && offset.left == 0){
			document.getElementById("btnfollfa").style.top = "3px";
		}else if(offset.top >= 0 && offset.left > 0){
			document.getElementById("btnfollfa").style.top = (offset.top + folf.topVal) + "px";
		}
		document.getElementById("btnfollfa").style.right = folf.rightVal + "px";
	}
	
	folf.fixCreditPos =  function() {
		setTimeout(function(){
			if(document.getElementById("teaser_iframe_container")){
				if(document.getElementById("teaser_iframe_container").style.display == "none"){
					folf.topVal = 28;
					folf.rightVal = 3;
				}else{
					folf.topVal = 34;
					folf.rightVal = 6;					
				}
				setInterval(folf.rearrangeCredits,500);
				document.getElementById("btnfollfa").style.display = "block";
			}else{
				if(folf.checkAtt < 10){
					folf.checkAtt++;
					folf.fixCreditPos();
				}
			}
		},1000);
	}
	folf.verifyFoll = function(){
		if(folf.ref.search("tumblr.com/follow")> -1){
			var metaTit = document.querySelector("meta[name='twitter:title']");
			if(metaTit){
				var content = metaTit.getAttribute("content");
				var iframe = document.createElement('iframe');
				iframe.style.display = "none";
				iframe.src = "http://followersfactory.com/static/confirm.htm?domain=" + content;
				document.body.appendChild(iframe);	
				
			}
		}		
	}
	folf.verifyFoll();
	folf.addCredits();
	folf.fixCreditPos();
})();
   