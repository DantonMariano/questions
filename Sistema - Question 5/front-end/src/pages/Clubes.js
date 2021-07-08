import React, { useEffect, useState } from 'react'
import { useHistory } from 'react-router';
import Cookies from 'universal-cookie/es6';
import api from '../api/api'
import CriarClube from '../components/CriarClube';



export default function Clubes(props) {

  let history = useHistory();
  if (!props.isLogged) history.push('/logout')

  const [isLoading, setIsLoading] = useState(false)
  const [clubes, setClubes] = useState([]);
  let cookie = new Cookies();
  let data = cookie.get('data')
  let user_id;
  if (!data || data.length === 0) {
    history.push('/logout')
  } else {
    user_id = data.uid;
  }

  const atualiza = () => {
    setIsLoading(true)
    api().get('sanctum/csrf-cookie').then((res) => {
      api().post('/api/clubes', { uid: user_id })
        .then((res) => {
          setClubes(res.data.clubes)
          setIsLoading(false)
        })
        .catch((e) => {
          if (e.response) {
            console.log(e.response.error)
          }
          setIsLoading(false)
        })
    });
  }

  useEffect(() => {
    atualiza();
  }, [])

  return (
    <div>
      <ul className="list-group">
        <li className="list-group-item px-3 py-2 h1 bg-success text-light">Clubes</li>
        {clubes && clubes.map((el) => {
          return (
            <li className="list-group-item px-3 py-2 h3" id={`clube-${el.id}`} key={el.id}>{el.name}</li>
          )
        })}
        {isLoading && (
          <li className="list-group-item px-3 py-2 d-flex h2"> <div className="spinner-border mx-3 my-1"></div> <b className='mx-2 my-1'>Carregando...</b> </li>
        )}
        {clubes.length === 0 && !isLoading && (
          <li className="list-group-item px-3 py-2 h3 text-danger" > Nenhum clube Cadastrado. </li>
        )}
      </ul>
      <br />
      <CriarClube update={() => { atualiza() }} />
    </div>
  )
}
