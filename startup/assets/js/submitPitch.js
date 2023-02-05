 // File Upload
//
function ekUpload(){
    function Init() {
  
      var fileSelect    = document.getElementById('file-upload'),
          fileDrag      = document.getElementById('file-drag');
          // submitButton  = document.getElementById('submit-button');
  
      fileSelect.addEventListener('change', fileSelectHandler, false);
  
      // Is XHR2 available?
      var xhr = new XMLHttpRequest();
      if (xhr.upload) {
        // File Drop
        fileDrag.addEventListener('dragover', fileDragHover, false);
        fileDrag.addEventListener('dragleave', fileDragHover, false);
        fileDrag.addEventListener('drop', fileSelectHandler, false);
      }
    }
  
    function fileDragHover(e) {
      var fileDrag = document.getElementById('file-drag');
  
      e.stopPropagation();
      e.preventDefault();
  
      fileDrag.className = (e.type === 'dragover' ? 'hover' : 'modal-body file-upload');
    }
  
    function fileSelectHandler(e) {
      // Fetch FileList object
      var files = e.target.files || e.dataTransfer.files;
  
      // Cancel event and hover styling
      fileDragHover(e);
  
      // Process all File objects
      for (var i = 0, f; f = files[i]; i++) {
        parseFile(f);
        // uploadFile(f);
      }
    }
  
    // Output
    function output(msg) {
      // Response
      var m = document.getElementById('messages');
      m.innerHTML = msg;
    }
  
    function parseFile(file) {
  
      console.log(file.name);
      output(
        '<strong>' + encodeURI(file.name) + '</strong>'
      );
      
      // var fileType = file.type;
      // console.log(fileType);
      var imageName = file.name;
  
      var isGood = (/\.(?=gif|jpg|png|jpeg)/gi).test(imageName);
      if (isGood) {
        document.getElementById('start').classList.add("hidden");
        document.getElementById('response').classList.remove("hidden");
        document.getElementById('notimage').classList.add("hidden");
        // Thumbnail Preview
        document.getElementById('file-image').classList.remove("hidden");
        document.getElementById('file-image').src = URL.createObjectURL(file);
      }
      else {
        document.getElementById('file-image').classList.add("hidden");
        document.getElementById('notimage').classList.remove("hidden");
        document.getElementById('start').classList.remove("hidden");
        document.getElementById('response').classList.add("hidden");
        document.getElementById("file-upload-form").reset();
      }
    }
  
    // Check for the various File API support.
    if (window.File && window.FileList && window.FileReader) {
      Init();
    } else {
      document.getElementById('file-drag').style.display = 'none';
    }
}


function ekUpload2(){
    function Init2() {
  
      var fileSelect2    = document.getElementById('file2-upload'),
          fileDrag2      = document.getElementById('file2-drag');

  
      fileSelect2.addEventListener('change', fileSelectHandler2, false);
  
      // Is XHR2 available?
      var xhr2 = new XMLHttpRequest();
      if (xhr2.upload) {
        // File Drop
        fileDrag2.addEventListener('dragover', fileDragHover2, false);
        fileDrag2.addEventListener('dragleave', fileDragHover2, false);
        fileDrag2.addEventListener('drop', fileSelectHandler2, false);
      }
    }
  
    function fileDragHover2(e2) {
      var fileDrag2 = document.getElementById('file2-drag');
  
      e2.stopPropagation();
      e2.preventDefault();
  
      fileDrag2.className = (e2.type === 'dragover' ? 'hover' : 'modal-body file-upload');
    }
  
    function fileSelectHandler2(e2) {
      // Fetch FileList object
      var files2 = e2.target.files || e2.dataTransfer.files;
  
      // Cancel event and hover styling
      fileDragHover2(e2);
  
      // Process all File objects
      for (var i2 = 0, f2; f2 = files2[i2]; i2++) {
        parseFile2(f2);
        // uploadFile(f2);
      }
    }
  
    // Output
    function output2(msg2) {
      // Response
      var m2 = document.getElementById('messages2');
      m2.innerHTML = msg2;
    }
  
    function parseFile2(file2) {
  
      console.log(file2.name);
      output2(
        '<strong>' + encodeURI(file2.name) + '</strong>'
      );
      
      // var fileType = file.type;
      // console.log(fileType);
      var imageName2 = file2.name;
  
      var isGood2 = (/\.(?=gif|jpg|png|jpeg)/gi).test(imageName2);
      if (isGood2) {
        document.getElementById('start2').classList.add("hidden");
        document.getElementById('response2').classList.remove("hidden");
        document.getElementById('notimage2').classList.add("hidden");
        // Thumbnail Preview
        document.getElementById('file2-image').classList.remove("hidden");
        document.getElementById('file2-image').src = URL.createObjectURL(file2);
      }
      else {
        document.getElementById('file2-image').classList.add("hidden");
        document.getElementById('notimage2').classList.remove("hidden");
        document.getElementById('start2').classList.remove("hidden");
        document.getElementById('response2').classList.add("hidden");
        document.getElementById("file2-upload-form").reset();
      }
    }
  
    // Check for the various File API support.
    if (window.File && window.FileList && window.FileReader) {
      Init2();
    } else {
      document.getElementById('file2-drag').style.display = 'none';
    }
}


function ekUpload3(){
  function Init3() {

    var fileSelect3    = document.getElementById('file3-upload'),
        fileDrag3     = document.getElementById('file3-drag');


    fileSelect3.addEventListener('change', fileSelectHandler3, false);

    // Is XHR2 available?
    var xhr3 = new XMLHttpRequest();
    if (xhr3.upload) {
      // File Drop
      fileDrag3.addEventListener('dragover', fileDragHover3, false);
      fileDrag3.addEventListener('dragleave', fileDragHover3, false);
      fileDrag3.addEventListener('drop', fileSelectHandler3, false);
    }
  }

  function fileDragHover3(e3) {
    var fileDrag3 = document.getElementById('file3-drag');

    e3.stopPropagation();
    e3.preventDefault();

    fileDrag3.className = (e3.type === 'dragover' ? 'hover' : 'modal-body file3-upload');
  }

  function fileSelectHandler3(e3) {
    // Fetch FileList object
    var files3 = e3.target.files || e2.dataTransfer.files;

    // Cancel event and hover styling
    fileDragHover3(e3);

    // Process all File objects
    for (var i3 = 0, f3; f3 = files3[i3]; i3++) {
      parseFile3(f3);
      // uploadFile(f2);
    }
  }

  // Output
  function output3(msg3) {
    // Response
    var m3 = document.getElementById('messages3');
    m3.innerHTML = msg3;
  }

  function parseFile3(file3) {

    console.log(file3.name);
    output3(
      '<strong>' + encodeURI(file3.name) + '</strong>'
    );
    
    // var fileType = file.type;
    // console.log(fileType);
    var imageName3 = file3.name;

    var isGood3 = (/\.(?=mp4|mkv||FLV||MOV||AVI||WMV)/gi).test(imageName3);
    if (isGood3) {
      document.getElementById('start3').classList.add("hidden");
      document.getElementById('response3').classList.remove("hidden");
      document.getElementById('notimage3').classList.add("hidden");
      // Thumbnail Preview
      document.getElementById('file-video').classList.remove("hidden");
      document.getElementById('file-video').src = URL.createObjectURL(file3);
      document.getElementById('file-video').play();

    }
    else {
      document.getElementById('file-video').classList.add("hidden");
      document.getElementById('notimage3').classList.remove("hidden");
      document.getElementById('start3').classList.remove("hidden");
      document.getElementById('response3').classList.add("hidden");
      document.getElementById("file3-upload-form").reset();
    }
  }

  // Check for the various File API support.
  if (window.File && window.FileList && window.FileReader) {
    Init3();
  } else {
    document.getElementById('file3-drag').style.display = 'none';
  }
}


function ekUpload4(){
    function Init4() {
  
      var fileSelect4    = document.getElementById('file4-upload'),
          fileDrag4      = document.getElementById('file4-drag');

  
      fileSelect4.addEventListener('change', fileSelectHandler4, false);
  
      // Is XHR2 available?
      var xhr4 = new XMLHttpRequest();
      if (xhr4.upload) {
        // File Drop
        fileDrag4.addEventListener('dragover', fileDragHover4, false);
        fileDrag4.addEventListener('dragleave', fileDragHover4, false);
        fileDrag4.addEventListener('drop', fileSelectHandler4, false);
      }
    }
  
    function fileDragHover4(e4) {
      var fileDrag4 = document.getElementById('file4-drag');
  
      e4.stopPropagation();
      e4.preventDefault();
  
      fileDrag4.className = (e4.type === 'dragover' ? 'hover' : 'modal-body file-upload');
    }
  
    function fileSelectHandler4(e4) {
      // Fetch FileList object
      var files4 = e4.target.files || e2.dataTransfer.files;
  
      // Cancel event and hover styling
      fileDragHover4(e4);
  
      // Process all File objects
      for (var i4 = 0, f4; f4 = files4[i4]; i4++) {
        parseFile4(f4);
        // uploadFile(f2);
      }
    }
  
    // Output
    function output4(msg4) {
      // Response
      var m4 = document.getElementById('messages4');
      m4.innerHTML = msg4;
    }
  
    function parseFile4(file4) {
  
      console.log(file4.name);
      output4(
        '<strong>' + encodeURI(file4.name) + '</strong>'
      );
      
      // var fileType = file.type;
      // console.log(fileType);
      var imageName4 = file4.name;
  
      var isGood4 = (/\.(?=pdf)/gi).test(imageName4);
      if (isGood4) {
        document.getElementById('start4').classList.add("hidden");
        document.getElementById('response4').classList.remove("hidden");
        document.getElementById('notimage4').classList.add("hidden");
        // Thumbnail Preview
        document.getElementById('file4-image').classList.remove("hidden");
        document.getElementById('file4-image').src = URL.createObjectURL(file4);
      }
      else {
        document.getElementById('file4-image').classList.add("hidden");
        document.getElementById('notimage4').classList.remove("hidden");
        document.getElementById('start4').classList.remove("hidden");
        document.getElementById('response4').classList.add("hidden");
        document.getElementById("file4-upload-form").reset();
      }
    }
  
    // Check for the various File API support.
    if (window.File && window.FileList && window.FileReader) {
      Init4();
    } else {
      document.getElementById('file4-drag').style.display = 'none';
    }
}
  

ekUpload();
ekUpload2();
ekUpload3();
ekUpload4();


// Jquery Dependency

$("input[data-type='currency']").on({
    keyup: function() {
      formatCurrency($(this));
    },
    blur: function() { 
      formatCurrency($(this), "blur");
      $("input[data-type='currency']").blur();
    }
});


function formatNumber(n) {
  // format number 1000000 to 1,234,567
  return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}


function formatCurrency(input, blur) {
  // appends $ to value, validates decimal side
  // and puts cursor back in right position.
  
  // get input value
  var input_val = input.val();
  
  // don't validate empty input
  if (input_val === "") { return; }
  
  // original length
  var original_len = input_val.length;

  // initial caret position 
  var caret_pos = input.prop("selectionStart");
    
  // check for decimal
  if (input_val.indexOf(".") >= 0) {

    // get position of first decimal
    // this prevents multiple decimals from
    // being entered
    var decimal_pos = input_val.indexOf(".");

    // split number by decimal point
    var left_side = input_val.substring(0, decimal_pos);
    var right_side = input_val.substring(decimal_pos);

    // add commas to left side of number
    left_side = formatNumber(left_side);

    // validate right side
    right_side = formatNumber(right_side);
    
    // On blur make sure 2 numbers after decimal
    if (blur === "blur") {
      right_side += "00";
    }
    
    // Limit decimal to only 2 digits
    right_side = right_side.substring(0, 2);

    // join number by .
    input_val = "$" + left_side + "." + right_side;

  } else {
    // no decimal entered
    // add commas to number
    // remove all non-digits
    input_val = formatNumber(input_val);
    input_val = "$" + input_val;
    
    // final formatting
    if (blur === "blur") {
      input_val += ".00";
    }
  }
  
  // send updated string to input
  input.val(input_val);

  // put caret back in the right position
  var updated_len = input_val.length;
  caret_pos = updated_len - original_len + caret_pos;
  input[0].setSelectionRange(caret_pos, caret_pos);
}

   