import React, { useEffect, useState } from 'react'
import Cookies from 'universal-cookie/es6';

export default function HomePage(props) {

  const [data, setData] = useState('');
  const isLogged = props.isLogged;
  
  useEffect(()=>{
    let cookie = new Cookies();
    if(isLogged) setData(cookie.get('data'));
  }, [isLogged])

  return (
    <div align='center'>
      {isLogged && (
        <>
          <h1> Bem-Vindo! {data.username} </h1>
        </>
      )}
      {!isLogged && (
        <>
          <h1>Bem-vindo!</h1>
        </>
      )}
    </div>
  )
}
