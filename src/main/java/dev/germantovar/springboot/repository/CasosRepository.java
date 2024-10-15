package dev.germantovar.springboot.repository;

import dev.germantovar.springboot.entities.Casos;
import org.springframework.data.repository.CrudRepository;
import org.springframework.stereotype.Repository;

import java.util.List;

@Repository
public interface CasosRepository extends CrudRepository<Casos, Long> {

    List<Casos> findByAbogados_Id(Long idAbogado);

    List<Casos> findByClientes_Id(Long idCliente);

}
