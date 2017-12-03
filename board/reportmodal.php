<!DOCTYPE html>
<html>

<head>
  <title>showModalDialog</title>
</head>

<body>
  <form id="oForm">
    Dialog Height 
    <select id="oHeight">
      <option>-- Random --</option>
      <option>150</option>
      <option>200</option>
      <option>250</option>
      <option>300</option>
    </select>
    <p>Create Modal Dialog Box</p>
    <input type="button" value="Push To Create" onclick="fnOpen()" />
  </form>
  <script>
    function fnRandom(iModifier) {
      return parseInt(Math.random() * iModifier);
    }

    function fnSetValues() {
      var oForm = document.getElementById('oForm');
      var iHeight = oForm.oHeight.options[oForm.oHeight.selectedIndex].text;

      if (iHeight.indexOf("Random") > -1) {
        iHeight = fnRandom(document.body.clientHeight);
      }

      var sFeatures = "dialogHeight: " + iHeight + "px;";
      return sFeatures;
    }

    function fnOpen() {
      var sFeatures = fnSetValues();
      window.showModalDialog("showModalDialog_target.htm", "", sFeatures)
    }
  </script>
</body>

</html>
