import { useEffect } from 'react'
import { useHistory } from 'react-router';
import Cookies from 'universal-cookie/es6';

export default function Logout(props) {
  let history = useHistory();
  let cookie = new Cookies();

  useEffect(()=>{
    cookie.remove('data');
    props.logout(true);
    history.push('/');
  }, [])

  return null;
}
