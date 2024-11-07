package dev.germantovar.springboot.controllers;
import dev.germantovar.springboot.entities.Abogados;

import dev.germantovar.springboot.entities.Casos;
import dev.germantovar.springboot.repository.AbogadosRepository;

import dev.germantovar.springboot.services.IAbogadosService;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;
import java.util.List;
import java.util.Optional;

@RestController
public class AbogadosController {

    @Autowired
    private IAbogadosService service;


    @Autowired
    AbogadosRepository abogadosRepository;

    @GetMapping("abogados")
    public List<Abogados> getAll() {return service.getAll();}

    @GetMapping("/abogados/{id}")
    public ResponseEntity<Abogados> getCasoById(@PathVariable Long id) {
        Abogados abogados = abogadosRepository.findById(id)
                .orElseThrow(() -> new RuntimeException("Abogado no encontrado con ID: " + id));
        return ResponseEntity.ok(abogados);
    }

    @PostMapping("envioabogados")
    public void save(@RequestBody Abogados abogados){
        service.save(abogados);
    }

    @PutMapping("/abogados/{id}")
    public ResponseEntity<Abogados> updateTutorial(@PathVariable("id") long id, @RequestBody Abogados abogados) {
        Optional<Abogados> abogadossData = abogadosRepository.findById(id);
        if (abogadossData.isPresent()) {
            Abogados _abogadoss = abogadossData.get();
            _abogadoss.setCedula(abogados.getCedula());
            _abogadoss.setNombre(abogados.getNombre());
            _abogadoss.setTelefono(abogados.getTelefono());
            _abogadoss.setCorreo(abogados.getCorreo());
            _abogadoss.setCargo(abogados.getCargo());
            _abogadoss.setUsuarios(abogados.getUsuarios());
            return new ResponseEntity<>(abogadosRepository.save(_abogadoss), HttpStatus.OK);
        } else {
            return new ResponseEntity<>(HttpStatus.NOT_FOUND);
        }
    }

    @DeleteMapping("envioabogados/eliminar/{id}")
    public void remove(@PathVariable String id) {
        service.remove(Long.parseLong(id)); // No es necesario convertir, ya que es Long
    }
}
