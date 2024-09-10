package dev.germantovar.springboot.repository;

import dev.germantovar.springboot.entities.Casos;
import org.springframework.data.repository.CrudRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface CasosRepository extends CrudRepository<Casos, Long> {
}
