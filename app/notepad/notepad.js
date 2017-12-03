/**
 * Created by chou6 on 2017-08-04.
 */
var showingSourceCode = false;
var isIneditMdde = true;
window.addEventListener("load", function () {
    init('textarea');
    var inputfile = document.getElementById('inputfile');
}, false);

function init(target, width, height) {

    var menu = {

        fontGroup : {
            bold: {
                type: "button",
                class: "fa fa-bold",
                events : {
                    click: function () {
                        changeState(this);
                        exec('bold');
                    }
                }

            },
            italic: {
                type: "button",
                class: "fa fa-italic",
                events : {
                    click: function () {
                        changeState(this);
                        exec('italic');
                    }
                }

            },
            underline: {
                type : "button",
                class : "fa fa-underline",
                events : {
                    click: function () {
                        changeState(this);
                        exec('underline');
                    }
                }

            },
            strikeThrough: {
                type : "button",
                class : "fa fa-strikethrough",
                events : {
                    click: function () {
                        changeState(this);
                        exec('strikeThrough');
                    }
                }

            }
        }
        ,

        alignGroup : {
            justifyLeft : {
                type : "button",
                class : "fa fa-align-left",
                events : {
                    click: function () {
                        changeState(this);
                        off("hycube_justifyCenter");
                        off("hycube_justifyRight");
                        off("hycube_justifyFull");
                        exec('justifyLeft');
                    }
                }

            },
            justifyCenter : {
                type : "button",
                class : "fa fa-align-center",
                events : {
                    click: function () {
                        changeState(this);
                        off("hycube_justifyLeft");
                        off("hycube_justifyRight");
                        off("hycube_justifyFull");
                        exec('justifyCenter');
                    }
                }
            },
            justifyRight : {
                type : "button",
                class : "fa fa-align-right",
                events : {
                    click: function () {
                        changeState(this);
                        off("hycube_justifyCenter");
                        off("hycube_justifyLeft");
                        off("hycube_justifyFull");
                        exec("justifyRight");
                    }
                }

            },
            justifyFull : {
                type : "button",
                class : "fa fa-align-justify",
                events : {
                    click: function () {
                        changeState(this);
                        off("hycube_justifyCenter");
                        off("hycube_justifyRight");
                        off("hycube_justifyLeft");
                        exec("justifyFull");
                    }
                }

            }
        }
       ,
        indentGroup : {
            indent : {
                type : "button",
                class : "fa fa-indent",
                events : {
                    click: function () {
                        exec("indent");
                    }
                }

            },
            outdent : {
                type : "button",
                class : "fa fa-outdent",
                events : {
                    click: function () {
                        exec("outdent");
                    }
                }

            }
        }
        ,
        subGroup : {

            subscript : {
                type : "button",
                class : "fa fa-subscript",
                events : {
                    click: function () {
                        exec("subscript");
                    }
                }

            },
            superscript : {
                type : "button",
                class : "fa fa-superscript",
                events : {
                    click: function () {
                        exec("superscript");
                    }
                }

            }
        },
        rollBack : {
            undo : {
                type : "button",
                class : "fa fa-undo",
                events : {
                    click: function () {
                        exec("undo");
                    }
                }

            },
            redo : {
                type : "button",
                class : "fa fa-repeat",
                events : {
                    click: function () {
                        exec("redo");
                    }
                }

            }
        },

        insertList : {
            insertUnorderedList : {
                type : "button",
                class : "fa fa-list-ul",
                events : {
                    click: function () {
                        exec("insertUnorderedList");
                    }
                }

            },
            insertOrderedList : {
                type : "button",
                class : "fa fa-list-ol",
                events : {
                    click: function () {
                        exec("insertOrderedList");
                    }
                }

            }
        },

        paraGraph : {
            insertParagraph : {
                type : "button",
                class : "fa fa-paragraph",
                events : {
                    click: function () {
                        exec("insertParagraph");
                    }
                }

            }
        }
        ,
        hSize : {
            formatBlock : {
                type : "select",
                class : "",
                events : {
                    change : function () {
                        execArg('formatBlock', this.value);
                    }
                },
                option : ["H1", "H2", "H3", "H4", "H5", "H6"]

            }
        },

        linkFunc : {
            createLink : {
                type : "button",
                class : "fa fa-link",
                events : {
                    click: function () {
                        execArg('createLink', prompt('Enter a URL', 'http://'));
                    }
                }

            },
            unlink : {
                type : "button",
                class : "fa fa-unlink",
                events : {
                    click: function () {
                        exec("unlink");
                    }
                }

            }
        }
        ,
        sourceGroup : {
            source : {
                type : "button",
                class : "fa fa-code",
                events : {
                    click: function () {
                        source();
                    }
                }

            }
        },

        fontConfig : {
            fonttype : {
                type : "select",
                class : "",
                events : {
                    change : function () {
                        execArg('fontName', this.value);
                    }
                },
                option : ["Arial", "Comic Sans Ms", "Courier", "Times New Romal", "Verdana"]

            },

            fontsize : {
                type : "select",
                class : "",
                events : {
                    click: function () {
                        execArg('fontSize', this.value);
                    }
                },
                option : ["1", "2", "3", "4", "5","6"]
            },

            forecolor : {
                type : "color",
                class : "",
                events : {
                    click: function () {
                        execArg('foreColor', this.value);
                    }
                }
            },

            background : {
                type : "color",
                class : "",
                events : {
                    click: function () {
                        execArg('hiliteColor', this.value);
                    }
                }
            }
        }
        ,
        fileGroup : {
            image : {
                type : "button",
                class : "fa fa-file-image-o",
                events : {
                    click: function () {
                        invoke('inputfile');
                    }
                }
            },

            inputfile : {
                type : "file",
                class : "",
                events : {
                    change : function () {
                        loadImg();
                    }
                }
            }
        }

    };
    if (target) {
        var textarea = document.getElementById(target);
        var parent = textarea.parentNode;
        var rootdiv = document.createElement("div");
        var menudiv = document.createElement("div");
        menudiv.setAttribute('class','menudiv');
        loadMenu(menu, menudiv);

        if((!width) && (!height)){
            width = 500;
            height = 400;
        }
        rootdiv.style.width=width + "px";
        rootdiv.style.height= height + "px";
        menudiv.style.width = (width-40) + "px";

        rootdiv.setAttribute('class','hycube_notepad');
        rootdiv.setAttribute('id','notepad');
        var editor = document.createElement("iframe");
        editor.setAttribute("name", "hycube_editor");
        editor.setAttribute("id", "hycube_editor");
        editor.setAttribute("class", "hycube_editor");
        editor.style.width = (width-30) + "px";




        rootdiv.insertBefore(menudiv, rootdiv.firstChild);
        rootdiv.insertBefore(editor, menudiv.nextSibling);
        parent.insertBefore(rootdiv,textarea.nextSibling);

        editorText = editor.contentDocument;
        editorText.designMode='on';
        editorText.body.style.overflowX = "hidden";
        editorText.body.style.display = "block";
        editorText.body.style.wordBreak = "break-all";
        editorText.body.innerHTML="<p><br></p>"
        editor.style.height = (height - menudiv.clientHeight) + "px";
        editorText.body.addEventListener('click',function () {

            checkState('bold');
            checkState('italic');
            checkState('underline');
            checkState('strikeThrough');
            checkState('justifyRight');
            checkState('justifyLeft');
            checkState('justifyCenter');
            checkState('justifyFull');
        })
        editorText.body.addEventListener("keydown", function (e) {
            if (e.keyCode === 13) {
                editorText.execCommand('formatblock',false,"P");
            }
        })
    }



}
function formsubmit(target, formid) {
    var textarea = document.getElementById(target);
    var form = document.getElementById(formid);
    textarea.value = window.frames['hycube_editor'].document.body.innerHTML;
    form.submit();
}

function image() {
    var imgSrc = prompt('Enter image location', '');
    if (imgSrc != null) {
        var editor = document.getElementById('hycube_editor').contentDocument;
        editor.document.execCommand('insertimage', false, imgSrc);
    }
}
function source() {
    var editor = document.getElementById('hycube_editor').contentDocument;
    if (showingSourceCode) {
        editor.body.innerHTML = editor.body.textContent;
        showingSourceCode = false;
        editor.body.style.backgroundColor = "white";
        editor.body.style.color = "black";

    } else {
        showingSourceCode = true;
        editor.body.textContent = editor.body.innerHTML;
        editor.body.style.background = "black";
        editor.body.style.color = "white";
        reset();
    }
}
function loadImg() {
    var filesSelected = document.getElementById("inputfile").files;

    if (filesSelected.length > 0) {
        var fileToLoad = filesSelected[0];

        if (fileToLoad.type.match("image.*")) {
            var fileReader = new FileReader();
            fileReader.onload = function (fileLoadedEvent) {
                var imageLoaded = editor.document.createElement("img");
                imageLoaded.src = fileLoadedEvent.target.result;
                editor.document.body.appendChild(imageLoaded);
            };
            fileReader.readAsDataURL(fileToLoad);
        }
    }
    var inputfile = document.getElementById('inputfile').files;

}
function setSize(){

}
function loadMenu(menu, menudiv) {
    for (var group in menu){

        var menuGroup = document.createElement("div");
        menuGroup.setAttribute('class','btnGroup');
        for(var obj in menu[group]){

            var tmp = menu[group][obj];
            var type = tmp.type;
            if(type == "button"){
                var button = document.createElement("button");
                button.type = type;
                button.setAttribute('id',"hycube_" + obj);
                for(var evt in tmp.events){
                    button.addEventListener(evt, tmp.events[evt]);

                }
                var inode = document.createElement("i");
                inode.setAttribute('class', tmp.class);
                button.appendChild(inode);
                menuGroup.appendChild(button)
            }else if(type == "select"){
                var select = document.createElement("select");
                var option = tmp.option;
                for(var evt in tmp.events){
                    select.addEventListener(evt, tmp.events[evt]);
                }
                option.forEach(function (item, index) {
                    var opel = document.createElement("option");
                    opel.value = item;
                    opel.innerText = item;
                    select.appendChild(opel);
                })

                menuGroup.appendChild(select);
            }else if(type == "color" || type == "file"){
                var button;
                if(type == "color"){
                    button = document.createElement("input");
                    button.type = type;
                    button.setAttribute('class', tmp.class);
                    for(var evt in tmp.events) {
                        button.addEventListener(evt, tmp.events[evt]);
                    }
                }
                else{
                    button = document.createElement("input");
                    button.type = type;
                    button.setAttribute('class', tmp.class);
                    button.setAttribute('id', 'inputfile');
                    for(var evt in tmp.events) {
                        button.addEventListener(evt, tmp.events[evt]);
                    }
                }

                menuGroup.appendChild(button);

            }else{

            }

        }

        menudiv.appendChild(menuGroup)

    }

}

function exec(command) {
    document.getElementById('hycube_editor').contentDocument.execCommand(command, false, null);
}
function execArg(command, arg) {
    document.getElementById('hycube_editor').contentDocument.execCommand(command, false, arg);
}

function changeState(el) {
    if(el.className.match(/(?:^|\s)active(?!\S)/)){
        el.className = el.className.replace(/(?:^|\s)active(?!\S)/g,'');
    }else{
        el.className += " active";
    }
}

function modify(elid, state){
    var el = document.getElementById(elid);
    if(state){
        if(!(el.className.match(/(?:^|\s)active(?!\S)/))){
            el.className += " active";
        }
    }else{
        el.className = el.className.replace(/(?:^|\s)active(?!\S)/g,'');
    }
}
function off(elid) {
    el = document.getElementById(elid);
    el.className = el.className.replace(/(?:^|\s)active(?!\S)/g,'');
}
function checkState(elid){
    var editor = document.getElementById('hycube_editor');
    if(editor.contentDocument.queryCommandState(elid)){
        modify('hycube_' + elid,true);
    }
    else{
        modify('hycube_' + elid,false);
    };
}
function reset(){
    var tmp = document.getElementById('hycube_editor').contentDocument;
    var text = tmp.body.textContent;
    if(empty(text)){
        console.log("true");
        tmp.body.textContent = "<p><br></p>";

    }else{
        console.log("false");

    }
}
function empty(el){
    var area = el;
    if(area == ''){
        return true
    }else{
        return false;
    }
}

function invoke(elId) {
    var evt;
    var el = document.getElementById(elId);
    if (document.createEvent) {
        evt = document.createEvent("MouseEvents");
        evt.initMouseEvent("click", true, true, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null);
    }
    (evt) ? el.dispatchEvent(evt) : (el.click && el.click());
}
