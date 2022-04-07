// ClassicEditor
// .create( document.querySelector( '#editor' ),{
//     removePlugins: [ 'Table' ],
//     plugins:[ 'Alignment' ],
//     alignment: {
//         options: [ 'left', 'right', 'center', 'justify' ]
//     },
//     toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'alignment', 'bulletedList', 'numberedList', 'blockQuote' ],
// } )
// .then( editor => {
// 	console.log( editor );
// } )
// .catch( error => {
// 	console.error( error );
// } );
// ClassicEditor.builtinPlugins.map( plugin => plugin.pluginName );
// Array.from( editor.ui.componentFactory.names() );

DecoupledEditor
.create( document.querySelector( '#editor' ),{
    
})
.then( editor => {
    const toolbarContainer = document.querySelector( '#toolbar-container' );

    toolbarContainer.appendChild( editor.ui.view.toolbar.element );
} )
.catch( error => {
    console.error( error );
} );
