/**
 * editor_plugin_src.js
 *
 * Copyright 2009, Moxiecode Systems AB
 * Released under LGPL License.
 *
 * License: http://tinymce.moxiecode.com/license
 * Contributing: http://tinymce.moxiecode.com/contributing
 */

(function() {
	// Load plugin specific language pack
	tinymce.PluginManager.requireLangPack('textlock');

	tinymce.create('tinymce.plugins.TextLockPlugin', {
		/**
		 * Initializes the plugin, this will be executed after the plugin has been created.
		 * This call is done before the editor instance has finished it's initialization so use the onInit event
		 * of the editor instance to intercept that event.
		 *
		 * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
		 * @param {string} url Absolute URL to where the plugin is located.
		 */
		init : function(ed, url) {
			// Register the command so that it can be invoked by using tinyMCE.activeEditor.execCommand('mcetextlock');
                        var t=this;
			t.editor=ed;
			ed.addCommand('mceTextLock', function() {
                                           
			//IE doesnt have getElementsByClassName
			function getElementsByClassName(name)
			{
			  	var elements = ed.dom.doc.getElementsByTagName("*");
			    	var result = [];
			      	for(z=0;z<elements.length;z++)
				{
				if(elements[z].getAttribute("class") == name)
				{
				 result.push(elements[z]);
				}
				}
				return result;
			}
		        //Remove data-mce-contenteditable forcefully to make the style formatter work
			var allNonEditableElements = getElementsByClassName('mceNonEditable');
			for (var i=0; i<allNonEditableElements.length; i++) 
			{ 
			allNonEditableElements[i].removeAttribute('data-mce-contenteditable');
			}
			//Removal Done
			ed.formatter.toggle("textlock");
			var refresh = ed.getContent(); ed.setContent(refresh);
			});

		        // Add a Custom Format	
		        
			ed.onInit.add(function(ed, e) {
              	      	ed.formatter.register('textlock', 
	                {inline: 'span', classes : ['mceNonEditable'] } );
						});
			
			// Register textlock button
			
			ed.addButton('textlock', {
                        title : 'Lock Text',
                        cmd : 'mceTextLock',
                        image : url + '/img/textlock.gif'
			                        });
			

			// Add a node change handler, selects the button in the UI when a image is selected
			ed.onNodeChange.add(function(ed, cm, n) {
				        active = ed.formatter.match('textlock');
					control = ed.controlManager.get('textlock').setActive(active);
					//cm.setActive('textlock', n.nodeName == 'IMG');
			});
		},

		/**
		 * Creates control instances based in the incomming name. This method is normally not
		 * needed since the addButton method of the tinymce.Editor class is a more easy way of adding buttons
		 * but you sometimes need to create more complex controls like listboxes, split buttons etc then this
		 * method can be used to create those.
		 *
		 * @param {String} n Name of the control to create.
		 * @param {tinymce.ControlManager} cm Control manager to use inorder to create new control.
		 * @return {tinymce.ui.Control} New control instance or null if no control was created.
		 */
		createControl : function(n, cm) {
			return null;
		},

		/**
		 * Returns information about the plugin as a name/value array.
		 * The current keys are longname, author, authorurl, infourl and version.
		 *
		 * @return {Object} Name/value array containing information about the plugin.
		 */
		getInfo : function() {
			return {
				longname : 'TextLock Plugin',
				author : 'Some author',
				authorurl : 'http://tinymce.moxiecode.com',
				infourl : 'http://wiki.moxiecode.com/index.php/TinyMCE:Plugins/textlock',
				version : "1.0"
			};
		}
	});

	// Register plugin
	tinymce.PluginManager.add('textlock', tinymce.plugins.TextLockPlugin);
})();
