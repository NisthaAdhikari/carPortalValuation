// 1. Handling the various events
// - get references to different elements we need
// - listen to drag, drop and change events
// - handle dropped and selected files

// get a reference to the file drop area and the file input
var fileDropArea = document.querySelector('.file-drop-area');
var fileInput = fileDropArea.querySelector('input');
var fileInputName = fileInput.name;

// listen to events for dragging and dropping
fileDropArea.addEventListener('dragover', handleDragOver);
fileDropArea.addEventListener('drop', handleDrop);
fileInput.addEventListener('change', handleFileSelect);

// need to block dragover to allow drop
function handleDragOver(e) {
  e.preventDefault();
}

// deal with dropped items,
function handleDrop(e) {
  e.preventDefault();
  handleFileItems(e.dataTransfer.items || e.dataTransfer.files);
}

// handle manual selection of files using the file input
function handleFileSelect(e) {
  handleFileItems(e.target.files);
}

// 2. Handle the dropped items
// - test if the item is a File or a DataTransferItem
// - do some expectation matching

// loops over a list of items and passes
// them to the next function for handling
function handleFileItems(items) {
  var l = items.length;
  for (var i=0; i<l; i++) {
    handleItem(items[i]);
  }
}

// handles the dropped item, could be a DataTransferItem
// so we turn all items into files for easier handling
function handleItem(item) {

  // get file from item
  var file = item;
  if (item.getAsFile && item.kind =='file') {
    file = item.getAsFile();
  }

  handleFile(file);
}

// now we're sure each item is a file
// the function below can test if the files match
// our expectations
function handleFile(file) {

  /*
  // you can check if the file fits all requirements here
  // for example:
  // if file is bigger then 1 MB don't load
  if (file.size > 1000000) {
    return;
  }
  */

  // if it does, create a cropper
  createCropper(file);
}

// 3. Create the Image Cropper
// - create an element for the cropper to bind to
// - add the element after the drop area
// - creat the cropper and bind the remove button so it
//   removes the entire cropper when clicked.

// create an Image Cropper for each passed file
function createCropper(file) {

  // create container element for cropper
  var cropper = document.createElement('div');

  // insert this element after the file drop area
  fileDropArea.parentNode.insertBefore(cropper, fileDropArea.nextSibling);

  // create a Slim Cropper
  $(cropper).slim( {
    ratio: '16:9',
    defaultInputName: fileInputName,
    didInit: function() {

      // load the file to our slim cropper
      this.load(file);

    },
    didRemove: function() {

      // detach from DOM
      cropper.parentNode.removeChild(cropper);

      // destroy the slim cropper
      this.destroy();

    }
  });

}

// 4. Disable the file input element

// hide file input, we can now upload with JavaScript
fileInput.style.display = 'none';

// remove file input name so it's value is
// not posted to the server
fileInput.removeAttribute('name');