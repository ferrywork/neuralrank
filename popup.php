<!-- popup html -->
<div class="overlay" id="overlay" style="display:none;"></div>
<div class="openbox" id="openbox" style="display:none;">
    <span class="s3-btn-close" onclick="popupClose();"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3 265.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256 310.6 150.6z"/></svg></span>
    <div class="popup-content">
        <div class="popup-role">
            <label>AI model for the title text generator</label>
            <div class="input-field">
                <select name="model" class="nl_input">
                    <option value="text-davinci-003">text-davinci-003 </option>
                    <option value="text-davinci-002" selected>text-davinci-002 </option>
                    <option value="text-curie-001">text-curie-001     </option>
                    <option value="text-babbage-001">text-babbage-001 </option>
                    <option value="text-ada-001">text-ada-001         </option>
                </select>
            </div>
        </div>
        <div class="popup-role">
            <label>AI content minimum chracter count</label>
            <div class="input-field">
                <input type="number" class="nl_input" value="500">
            </div>
        </div>


        <div class="popup-role">
            <label>maximum total token count to use per API request</label>
            <div class="input-field">
                <input type="number" class="nl_input" name="max_token" value="1000">
            </div>
        </div>
        <div class="popup-role">
            <label>AI temperature</label>
            <div class="input-field">
                <input type="number" class="nl_input" name="temperature" value="0.5">
            </div>
        </div>
    </div>
    <div class="col-inner action-button">
    <button type="submit" onclick="popupClose();">Save & Close</button>
    </div>
</div>


