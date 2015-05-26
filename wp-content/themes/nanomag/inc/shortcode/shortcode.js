
//Button Link
(function() {  
    tinymce.create('tinymce.plugins.button_link', {  
        init : function(ed, url) {  
            ed.addButton('button_link', {  
                title : 'Add Button',  
                image : url + '/img/button_link.png',  
                onclick : function() {  
					ed.focus();
                    ed.selection.setContent('[button_link size="medium" src="URL_HERE"]TEXT_HERE[/button_link]<br/>');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        }  
    });  
    tinymce.PluginManager.add('button_link', tinymce.plugins.button_link);  
})(); 

//blog quote
(function() {  
    tinymce.create('tinymce.plugins.quote', {  
        init : function(ed, url) {  
            ed.addButton('quote', {  
                title : 'Add quote',  
                image : url+'/img/quote.png',  
                onclick : function() {  
                     ed.selection.setContent('[quote]CONTENT_HERE[/quote]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        }
    });  
    tinymce.PluginManager.add('quote', tinymce.plugins.quote);  
})();



(function() {  
    tinymce.create('tinymce.plugins.tab', {  
        init : function(ed, url) {  
            ed.addButton('tab', {  
                title : 'Add Tab',  
                image : url + '/img/tab.png',  
                onclick : function() {  
					ed.focus();
                    ed.selection.setContent('[tab]<br/>\
						[tab_item title="TITLE"]CONTENT_HERE[/tab_item]<br/>\
						[tab_item title="TITLE"]CONTENT_HERE[/tab_item]<br/>\
						[tab_item title="TITLE"]CONTENT_HERE[/tab_item]<br/>\
						[/tab]<br/>');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        }
    });  
    tinymce.PluginManager.add('tab', tinymce.plugins.tab);  
})(); 

//slider
(function() {
    tinymce.create('tinymce.plugins.image_slider', {
        init : function(ed, url) {
            ed.addButton('image_slider', {
                title : 'Image Slider',
                image : url+'/img/gallery.png',
                onclick : function() {            
                ed.selection.setContent('[image_slider]<br/>\n\
[image_items link="LINK_IMAGE" source="IMAGE_SOURCE"] Description [/image_items]<br/>\n\
[image_items link="LINK_IMAGE" source="IMAGE_SOURCE"] Description  [/image_items]<br/>\n\
[image_items link="LINK_IMAGE" source="IMAGE_SOURCE"] Description  [/image_items]<br/>\n\
[/image_slider]');              
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('image_slider', tinymce.plugins.image_slider);
})();

//Audio
(function() {  
    tinymce.create('tinymce.plugins.audio', {  
        init : function(ed, url) {  
            ed.addButton('audio_mp3', {  
                title : 'Add audio',  
                image : url+'/img/audio.png',  
                onclick : function() {  
                     ed.selection.setContent('[audio_mp3 url="audio_url"]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        }
    });  
    tinymce.PluginManager.add('audio', tinymce.plugins.audio);  
})();


//Youtube
(function() {
    tinymce.create('tinymce.plugins.youtube', {
        init : function(ed, url) {
            ed.addButton('youtube', {
                title : 'Youtube',
                image : url+'/img/youtube.png',
                onclick : function() {            
                ed.selection.setContent('[youtube url="video_url" width="500" height="300"]');              
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('youtube', tinymce.plugins.youtube);
})();

//vimeo
(function() {
    tinymce.create('tinymce.plugins.vimeo', {
        init : function(ed, url) {
            ed.addButton('vimeo', {
                title : 'Vimeo',
                image : url+'/img/vimeo.png',
                onclick : function() {            
                ed.selection.setContent('[vimeo url="video_url" width="500" height="300"]');              
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('vimeo', tinymce.plugins.vimeo);
})();

