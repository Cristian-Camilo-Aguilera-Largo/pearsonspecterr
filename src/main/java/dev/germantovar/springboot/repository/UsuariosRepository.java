package dev.germantovar.springboot.repository;

import dev.germantovar.springboot.entities.Usuarios;
import org.springframework.data.repository.CrudRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface UsuariosRepository extends CrudRepository<Usuarios, Long>{
}
