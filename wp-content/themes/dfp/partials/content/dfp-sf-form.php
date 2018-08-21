<?php

global $DB_Helper, $DB_Content;

?>


<script type="text/javascript" async="" src="https://www.gstatic.com/recaptcha/api2/v1531759913576/recaptcha__en.js"></script>

<form action="https://login.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8" method="POST" id="sf-contact-form">

    <input type=hidden name="captcha_settings" value='{"keyname":"DFP_1","fallback":"true","orgId":"00D28000001Kgn6","ts":""}'>
    <input type=hidden name="oid" value="00D28000001Kgn6">
    <input type=hidden name="retURL" value="/contact">
    <input type="hidden" name="lead_source" value="Web">

    <?php echo $DB_Content->get_section_spacer(20); ?>

    <div class="form-group">
        <input id="first_name" maxlength="40" name="first_name" placeholder="First Name*" type="text" class="form-control" required/>
    </div>

    <div class="form-group">
        <input id="last_name" placeholder="Last Name*" maxlength="80" name="last_name" type="text" class="form-control" required/>
    </div>

    <div class="form-group">
        <input id="email" placeholder="Email*" maxlength="80" name="email"  type="text" class="required email" required/>
    </div>

    <div class="form-group">
        <input id="mobile" placeholder="Mobile*" maxlength="40" name="mobile" type="text" class="form-control" required/>
    </div>

    <div class="form-group">
        <input id="company" placeholder="Company" maxlength="40" name="company" type="text" class="form-control"/>
    </div>

    <div class="form-group">
        <input id="city" placeholder="City" maxlength="40" name="city" type="text" class="form-control"/>
    </div>

    <div class="form-group">
        <input id="state" placeholder="State/Province" maxlength="20" name="state" type="text" class="form-control"/>
    </div>

    <div class="form-group">
        <input id="country" placeholder="Country" maxlength="40" name="country" type="text" class="form-control"/>
    </div>

    <div class="form-group">
        <select id="00N2800000J0Fzx" name="00N2800000J0Fzx" title="How did you find out about us?" class="form-control">
            <option value="">How did you find out about us?</option>
            <option value="Urban Developer">Urban Developer</option>
            <option value="Google Search">Google Search</option>
            <option value="Linked In">Linked In</option>
            <option value="Referral">Referral</option>
            <option value="Other">Other</option>
            <option value="Event">Event</option>
        </select>
    </div>

    <div class="form-group">
        <select id="00N2800000J0G01" name="00N2800000J0G01" title="Services Required" class="form-control">
            <option value="">Services Required</option>
            <option value="Structured debt/equity">Structured debt/equity</option>
            <option value="Portfolio advisory">Portfolio advisory</option>
            <option value="Asset improvement strategy">Asset improvement strategy</option>
            <option value="Others">Others</option>
        </select>
    </div>

    <div class="form-group">
        <select id="00N2800000J0Fzv" name="00N2800000J0Fzv" title="Development Type" class="form-control">
            <option value="">Development Type</option>
            <option value="Residential">Residential</option>
            <option value="Commercial">Commercial</option>
            <option value="Industrial">Industrial</option>
            <option value="Office">Office</option>
            <option value="Retail">Retail</option>
            <option value="Others">Others</option>
        </select>
    </div>

    <div class="form-group">
        <select id="00N2800000J0Fzy" name="00N2800000J0Fzy" title="Project Location" class="form-control">
            <option value="">Project Location</option>
            <option value="ACT">ACT</option>
            <option value="NSW">NSW</option>
            <option value="NT">NT</option>
            <option value="SA">SA</option>
            <option value="VIC">VIC</option>
            <option value="QLD">QLD</option>
            <option value="TAS">TAS</option>
            <option value="WA">WA</option>
        </select>
    </div>

    <div class="form-group">
        <select id="00N2800000J0Fzz" name="00N2800000J0Fzz" title="Project Size" class="form-control">
            <option value="">Project Size</option>
            <option value="&lt;$2m">&lt;$2m</option>
            <option value="$2-5m">$2-5m</option>
            <option value="$5-10m">$5-10m</option>
            <option value="$10-20m">$10-20m</option>
            <option value="$20-50m">$20-50m</option>
            <option value="&lt;$50m">&lt;$50m</option>
        </select>
    </div>

    <div class="form-group">
        <textarea id="00N2800000J0G02" placeholder="Message" name="00N2800000J0G02" rows="1" type="text" wrap="soft" class="form-control"></textarea>
    </div>

    <div class="form-group">
        <div class="g-recaptcha" data-sitekey="6Le06xcUAAAAAJxGzJSHPp5hvHN_i_8C4gbHYSLW"></div>
        <input type="hidden" class="hiddenRecaptcha required" name="hiddenRecaptcha" id="hiddenRecaptcha">
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-full" name="submit">
    </div>
</form>


<script>
function timestamp() { var response = document.getElementById("g-recaptcha-response"); if (response == null || response.value.trim() == "") {var elems = JSON.parse(document.getElementsByName("captcha_settings")[0].value);elems["ts"] = JSON.stringify(new Date().getTime());document.getElementsByName("captcha_settings")[0].value = JSON.stringify(elems); } } setInterval(timestamp, 500); 
</script>

