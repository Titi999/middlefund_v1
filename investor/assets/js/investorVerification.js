;(function ($) {
  function createPdfPreview(fileContents, $displayElement) {
    PDFJS.disableWorker = true
    PDFJS.workerSrc =
      'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/1.7.365/pdf.worker.min.js'
    PDFJS.getDocument(fileContents).then(function (pdf) {
      pdf.getPage(1).then(function (page) {
        var $previewContainer = $displayElement.find('.preview__thumb')
        var canvas = $previewContainer.find('canvas')[0]
        canvas.height = $previewContainer.innerHeight()
        canvas.width = $previewContainer.innerWidth()

        var viewport = page.getViewport(1)
        var scaleX = canvas.width / viewport.width
        var scaleY = canvas.height / viewport.height
        var scale = scaleX < scaleY ? scaleX : scaleY
        var scaledViewport = page.getViewport(scale)

        var context = canvas.getContext('2d')
        var renderContext = {
          canvasContext: context,
          viewport: scaledViewport
        }
        page.render(renderContext)
      })
    })
  }

  function createPdfPreview2(fileContents, $displayElement) {
    PDFJS.disableWorker = true
    PDFJS.workerSrc =
      'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/1.7.365/pdf.worker.min.js'
    PDFJS.getDocument(fileContents).then(function (pdf) {
      pdf.getPage(1).then(function (page) {
        var $previewContainer = $displayElement.find('.preview__thumb2')
        var canvas = $previewContainer.find('canvas')[0]
        canvas.height = $previewContainer.innerHeight()
        canvas.width = $previewContainer.innerWidth()

        var viewport = page.getViewport(1)
        var scaleX = canvas.width / viewport.width
        var scaleY = canvas.height / viewport.height
        var scale = scaleX < scaleY ? scaleX : scaleY
        var scaledViewport = page.getViewport(scale)

        var context = canvas.getContext('2d')
        var renderContext = {
          canvasContext: context,
          viewport: scaledViewport
        }
        page.render(renderContext)
      })
    })
  }

  function createPreview(file, fileContents, mimeType, header) {
    var $previewElement = ''

    // If the mimetype was not defined earlier, try to get it from through the file API
    mimeType = mimeType === '' ? file.type : mimeType

    switch (mimeType) {
      case 'image/png':
      case 'image/jpeg':
      case 'image/gif':
        $previewElement = $('<img src="' + fileContents + '" />')
        break
      case 'video/mp4':
      case 'video/webm':
      case 'video/ogg':
        $previewElement = $(
          '<video autoplay muted width="100%" height="100%"><source src="' +
            fileContents +
            '" type="' +
            file.type +
            '"></video>'
        )
        break
      case 'application/pdf':
        $previewElement = $(
          '<canvas id="" width="100%" height="100%"></canvas>'
        )
        break
      default:
        break
    }
    var $displayElement = $(
      '<div class="preview">\
                               <div class="preview__thumb"></div>\
                               <span class="preview__name" title="' +
        file.name +
        '">' +
        file.name +
        '</span>\
                               <span class="preview__type" title="' +
        mimeType +
        '">' +
        mimeType +
        '</span>\
                             </div>'
    )
    $displayElement.find('.preview__thumb').append($previewElement)
    $('.upload__files').append($displayElement)

    if (mimeType === 'application/pdf') {
      createPdfPreview(fileContents, $displayElement)
    }
  }

  function createPreview1(file, fileContents, mimeType, header) {
    var $previewElement = ''

    // If the mimetype was not defined earlier, try to get it from through the file API
    mimeType = mimeType === '' ? file.type : mimeType

    switch (mimeType) {
      case 'image/png':
      case 'image/jpeg':
      case 'image/gif':
        $previewElement = $('<img src="' + fileContents + '" />')
        break
      case 'video/mp4':
      case 'video/webm':
      case 'video/ogg':
        $previewElement = $(
          '<video autoplay muted width="100%" height="100%"><source src="' +
            fileContents +
            '" type="' +
            file.type +
            '"></video>'
        )
        break
      case 'application/pdf':
        $previewElement = $(
          '<canvas id="" width="100%" height="100%"></canvas>'
        )
        break
      default:
        break
    }
    var $displayElement = $(
      '<div class="preview">\
                               <div class="preview__thumb"></div>\
                               <span class="preview__name" title="' +
        file.name +
        '">' +
        file.name +
        '</span>\
                               <span class="preview__type" title="' +
        mimeType +
        '">' +
        mimeType +
        '</span>\
                             </div>'
    )

    $displayElement.find('.preview__thumb').append($previewElement)
    $('.upload__files1').append($displayElement)

    if (mimeType === 'application/pdf') {
      createPdfPreview(fileContents, $displayElement)
    }
  }

  function createPreview2(file, fileContents, mimeType, header) {
    var $previewElement = ''

    // If the mimetype was not defined earlier, try to get it from through the file API
    mimeType = mimeType === '' ? file.type : mimeType

    switch (mimeType) {
      case 'image/png':
      case 'image/jpeg':
      case 'image/gif':
        $previewElement = $('<img src="' + fileContents + '" />')
        break
      case 'video/mp4':
      case 'video/webm':
      case 'video/ogg':
        $previewElement = $(
          '<video autoplay muted width="100%" height="100%"><source src="' +
            fileContents +
            '" type="' +
            file.type +
            '"></video>'
        )
        break
      case 'application/pdf':
        $previewElement = $(
          '<canvas id="" width="100%" height="100%"></canvas>'
        )
        break
      default:
        break
    }
    var $displayElement = $(
      '<div class="preview2">\
                               <div class="preview__thumb2"></div>\
                               <span class="preview__name2" title="' +
        file.name +
        '">' +
        file.name +
        '</span>\
                               <span class="preview__type2" title="' +
        mimeType +
        '">' +
        mimeType +
        '</span>\
                             </div>'
    )
    $displayElement.find('.preview__thumb2').append($previewElement)
    $('.upload__files2').append($displayElement)

    if (mimeType === 'application/pdf') {
      createPdfPreview2(fileContents, $displayElement)
    }
  }

  function getMimeType(file) {
    return new Promise(function (resolve, reject) {
      var mimeType = ''
      var fr = new FileReader()
      fr.onprogress = function (e) {
        var header = ''
        if (e.loaded > 4) {
          var arr = new Uint8Array(e.target.result).subarray(0, 4)
          for (var i = 0; i < arr.length; i++) {
            header += arr[i].toString(16)
          }
          switch (header) {
            case '89504e47':
              mimeType = 'image/png'
              break
            case '47494638':
              mimeType = 'image/gif'
              break
            case 'ffd8ffe0':
            case 'ffd8ffe1':
            case 'ffd8ffe2':
              mimeType = 'image/jpeg'
              break
            case '3026b275':
              mimeType = 'video/x-ms-wmv'
              break
            case '25504446':
              mimeType = 'application/pdf'
              break
            case '0001c':
            case '00018':
              mimeType = 'video/mp4'
              break
            case '1a45dfa3':
              mimeType = 'video/webm'
              break
            case '4f676753':
              mimeType = 'video/ogg'
              break
            case '464c561':
              mimeType = 'video/x-flv'
              break
            case '38425053':
              mimeType = 'psd'
              break
            case '504b34':
              mimeType = 'office document (doc, pptx, xlsx)'
              break
            default:
              mimeType = ''
          }
          console.log(file.name + ': ' + header)
          resolve({ file: file, header: header, type: mimeType })
          fr.abort()
          fr = null
        }
      }
      fr.readAsArrayBuffer(file)
    })
  }

  function fileInputChangeHandler(e) {
    var URL = window.URL || window.webkitURL
    var fileList = e.target.files

    if (fileList.length > 0) {
      $('.upload__files').html('')

      for (var i = 0; i < fileList.length; i++) {
        var file = fileList[i]
        getMimeType(file).then(function (info) {
          console.log(info)
          var fileUrl = URL.createObjectURL(info.file)
          createPreview(info.file, fileUrl, info.type, info.header)
        })
      }
    }
  }

  function fileInputChangeHandler1(e) {
    var URL = window.URL || window.webkitURL
    var fileList = e.target.files

    if (fileList.length > 0) {
      $('.upload__files1').html('')

      for (var i = 0; i < fileList.length; i++) {
        var file = fileList[i]
        getMimeType(file).then(function (info) {
          console.log(info)
          var fileUrl = URL.createObjectURL(info.file)
          createPreview1(info.file, fileUrl, info.type, info.header)
        })
      }
    }
  }

  function fileInputChangeHandler2(e) {
    var URL = window.URL || window.webkitURL
    var fileList = e.target.files

    if (fileList.length > 0) {
      $('.upload__files2').html('')

      for (var i = 0; i < fileList.length; i++) {
        var file = fileList[i]
        getMimeType(file).then(function (info) {
          console.log(info)
          var fileUrl = URL.createObjectURL(info.file)
          createPreview2(info.file, fileUrl, info.type, info.header)
        })
      }
    }
  }

  $(document).ready(function () {
    $('.upload__input:file').on('change', fileInputChangeHandler)
    $('.upload__input1:file').on('change', fileInputChangeHandler1)
    $('.upload__input2:file').on('change', fileInputChangeHandler2)
  })
})(jQuery.noConflict())
