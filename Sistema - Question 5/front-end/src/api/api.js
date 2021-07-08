import axios from "axios";
import Cookies from "universal-cookie/es6";


export default function api() {

  let cookie = new Cookies();

  const api = axios.create({
    baseURL: 'http://localhost:8000',
    withCredentials: true
  })


  api.interceptors.request.use((req)=>{
    let isLogged = cookie.get('data') ? cookie.get('data') : false;
    if (isLogged) cookie.set('data', { uid: isLogged.uid, username: isLogged.username}, { path: '/', maxAge: 600, sameSite: 'lax' })
    return req;
  },(err)=>{
    console.log(err);
  })
  return api;
}