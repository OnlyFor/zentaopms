import{r as e,h as t,F as i,g as s}from"./p-7900c24a.js";import{L as n}from"./p-986e5fe7.js";const r=class{constructor(t){e(this,t),this.currentSelection=null,this.itemLength=0,this.editor=void 0,this.items=void 0,this.props=void 0,this.currentSelectionIndex=0}onEditorChange(e){e&&(this.editor=e)}onItemsChange(e){e&&(this.items=e)}onPropsChange(e){e&&(this.props=e,this.items=e.items)}connectedCallback(){this.element.onkeydown=this.handleKeyDown.bind(this)}bindCommand(e){return e.action=this.props.command.bind(null,{action:e.action,editor:this.editor}),e}handleKeyDown(e){return!!["ArrowDown","ArrowUp","Enter"].includes(e.key)&&("ArrowDown"===e.key?(this.currentSelectionIndex=Math.min(this.currentSelectionIndex+1,this.itemLength-1),!0):"ArrowUp"===e.key?(this.currentSelectionIndex=Math.max(this.currentSelectionIndex-1,0),!0):"Enter"===e.key?(this.bindCommand(this.currentSelection).action(),!0):void 0)}render(){if(0===this.items.length)return null;let e=0;return this.itemLength="group"in this.items[0]?this.items.reduce(((e,t)=>e+t.items.length),0):this.items.length,this.currentSelectionIndex>=this.itemLength&&(this.currentSelectionIndex=0),t("div",{class:"zen-editor-slash-menu"},this.items.map((s=>"group"in s?t(i,null,t("div",{class:"group-title"},n.getString(`menu.group.${s.group}`)),s.items.map((i=>{const s=e++;return s===this.currentSelectionIndex&&(this.currentSelection=i),t("zen-editor-menu-item",{itemProps:Object.assign(Object.assign({},this.bindCommand(i)),{isActive:()=>s===this.currentSelectionIndex})})}))):(e===this.currentSelectionIndex&&(this.currentSelection=s),t("zen-editor-menu-item",{itemProps:Object.assign(Object.assign({},this.bindCommand(s)),{isActive:()=>e++===this.currentSelectionIndex})})))))}get element(){return s(this)}static get watchers(){return{editor:["onEditorChange"],items:["onItemsChange"],props:["onPropsChange"]}}};r.style=".zen-editor-slash-menu{display:flex;flex-direction:column;border:1px solid #a6a39e;border-radius:0.4em;background-color:white;padding:0.2em}.zen-editor-slash-menu .group-title{font-size:0.7em;font-weight:600;color:rgba(82, 82, 82, 0.5);font-family:sans-serif;text-transform:uppercase;user-select:none}.zen-editor-slash-menu zen-editor-menu-item .menu-item{display:flex;margin-right:unset;width:100%;padding-right:0.5em}.zen-editor-slash-menu zen-editor-menu-item .menu-item i{margin-right:0.5em}.zen-editor-slash-menu zen-editor-menu-item .menu-item .label{line-height:1.25em}.zen-editor-slash-menu .group-title~zen-editor-menu-item .menu-item{padding-left:0.5em}";export{r as zen_editor_slash_menu}