package dev.germantovar.springboot.repository;
import dev.germantovar.springboot.entities.Abogados;
import org.springframework.data.repository.CrudRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface AbogadosRepository extends CrudRepository<Abogados, Long>{
}
