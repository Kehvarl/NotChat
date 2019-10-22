<form name="" action="{ACTION}" target="Index" method=POST>
	<input type=hidden name=font value=verdana>
	<input type=hidden name=emot value=1>
	<input type=hidden name=bg_opt value=0>
	<input type=hidden name=font_opt value=1>
	<input type=hidden name=reg value=0>
	<input type=hidden name=chat value="{CHAT}">
	<input type=hidden name=action value="login">
	<input type=hidden name=logout_message value="logged!~!out!~!of!~!the!~!chat.">

	<span>
		Chat Name: 
	</span>
	<input type=text name=username maxlength=32>

	<span>
		Chat Color: 
	</span>
	<select name="color">
		{COLORLIST}
	</select>

	<span>
		Login Message:
	</span>
	<input type=text name=login_message value="enters.">

	<input type=submit value="Enter Chat">
</form>