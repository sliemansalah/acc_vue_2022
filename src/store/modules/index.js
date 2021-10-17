//auto require modules
import { kebabCase } from 'lodash';
const context = require.context('.', true, /\.(js)$/i);
let modules = {};
context.keys().map(i=>{
    if(i!='./index.js')
    modules[kebabCase(i.split(".")[1])] = context(i).default;
});
export default modules;
