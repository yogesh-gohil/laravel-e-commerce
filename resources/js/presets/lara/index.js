import avatar from './avatar'
import badge from './badge'
import breadcrumb from './breadcrumb'
import button from './button'
import calendar from './calendar'
import card from './card'
import checkbox from './checkbox'
import confirmpopup from './confirmpopup'
import datatable from './datatable'
import dialog from './dialog'
import divider from './divider'
import dropdown from './dropdown'
import fileupload from './fileupload'
import global from './global'
import image from './image'
import inlinemessage from './inlinemessage'
import inputgroup from './inputgroup'
import inputgroupaddon from './inputgroupaddon'
import inputmask from './inputmask'
import inputnumber from './inputnumber'
import inputswitch from './inputswitch'
import inputtext from './inputtext'
import menu from './menu'
import multiselect from './multiselect'
import overlaypanel from './overlaypanel'
import paginator from './paginator'
import panel from './panel'
import password from './password'
import radiobutton from './radiobutton'
import ripple from './ripple'
import selectbutton from './selectbutton'
import sidebar from './sidebar'
import skeleton from './skeleton'
import splitbutton from './splitbutton'
import steps from './steps'
import tabmenu from './tabmenu'
import tabview from './tabview'
import tag from './tag'
import textarea from './textarea'
import toast from './toast'
import togglebutton from './togglebutton'
import toolbar from './toolbar'
import tooltip from './tooltip'
export default {
  global,
  directives: {
    ripple,
    tooltip,
  },

  // forms
  dropdown,
  fileupload,
  inputnumber,
  inputtext,
  calendar,
  checkbox,
  radiobutton,
  inputswitch,
  selectbutton,
  multiselect,
  togglebutton,
  inputgroup,
  inputgroupaddon,
  inputmask,
  textarea,
  password,

  // buttons
  button,
  splitbutton,

  // data
  paginator,
  datatable,

  // panels
  panel,
  card,
  tabview,
  divider,
  toolbar,

  // menu
  menu,
  menubar,
  steps,
  breadcrumb,
  tabmenu,

  // overlays
  dialog,
  overlaypanel,
  sidebar,
  confirmpopup,

  // messages
  inlinemessage,
  toast,

  // media
  image,

  // misc
  badge,
  avatar,
  tag,
  skeleton,
}
