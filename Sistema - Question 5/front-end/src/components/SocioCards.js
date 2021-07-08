import React, { useState } from 'react'
import Associar from './Associar';
import Card from './Card';

export default function SocioCards(props) {
  let Socios = props.socios;

  return (
    <>
      {Socios && Socios.map((el) => {
        return (
          <Card key={el.id} socio={el} carregar={() => { props.atualizar() }} />
        )
      })}
      {Socios.length == 0 && !props.isLoading && (
        <div className="mx-3 my-1 h4 text-danger"> Nenhum sócio cadastrado.</div>
      )}
    </>
  )
}
