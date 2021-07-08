import React, { useEffect, useState } from 'react'
import Associar from './Associar';

export default function Card(props) {
  let socio = props.socio;
  const [associar, setAssociar] = useState(false)
  const [control, setControl] = useState(false)
  useEffect(() => {
    if (control) {
      props.carregar();
      setControl(false);
    }
  }, [control]);
  return (
    <div className="card my-2" style={{ width: '18rem', height: 'fit-content' }}>
      <div className="card-body">
        <h5 className="card-title h2" key={socio.id}>{socio.nome}</h5>
        <hr />
        {socio.Associados.length === 0 && (
          <>
            <p className="card-text h5">Não é Associado.</p>
          </>
        )}
        {socio.Associados.length > 0 && (
          <>
            <p className="card-text h5">Associado com:</p>
            <ul>
              {
                socio.Associados.map((el) => {
                  return (
                    <li key={el.id} id={`clube-${el.id}`}>
                      {el.nome}
                    </li>
                  )
                })
              }
            </ul>
          </>
        )}
        <hr />
        {!associar && (
          <button onClick={() => { setAssociar(true) }} className="btn btn-primary btn__form">Associar</button>
        )}
        {associar && (
          <Associar associar={() => { setAssociar(false) }} socio={socio} atualizar={() => { setControl(true) }} />
        )}
      </div>
    </div>
  )
}
