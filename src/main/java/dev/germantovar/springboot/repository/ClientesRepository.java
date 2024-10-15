package dev.germantovar.springboot.repository;
import dev.germantovar.springboot.entities.Abogados;
import dev.germantovar.springboot.entities.Clientes;
import org.springframework.data.repository.CrudRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface ClientesRepository extends CrudRepository<Clientes, Long> {
}
