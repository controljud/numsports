<?php

use Illuminate\Database\Seeder;
use App\Models\Campeonato;
use Illuminate\Support\Facades\DB;

class TemporadasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $campeonato = new Campeonato;
        $campeonato->nome = 'Campeonato Brasileiro';
        $campeonato->save();
        
        DB::table('temporadas')->insert([
            ['idCampeonato' => $campeonato->id, 'temporada' => '2020 - 2021', 'divisao' => 'Série A', 'sexo' => 'm', 'apelido' => 'Brasileirão', 'url' => 'https://chancedegol.com.br/br20.htm', 'status' => 1],
            ['idCampeonato' => $campeonato->id, 'temporada' => '2019', 'divisao' => 'Série A', 'sexo' => 'm', 'apelido' => 'Brasileirão', 'url' => 'https://chancedegol.com.br/br19.htm', 'status' => 0],
            ['idCampeonato' => $campeonato->id, 'temporada' => '2018', 'divisao' => 'Série A', 'sexo' => 'm', 'apelido' => 'Brasileirão', 'url' => 'https://chancedegol.com.br/br18.htm', 'status' => 0],
            ['idCampeonato' => $campeonato->id, 'temporada' => '2017', 'divisao' => 'Série A', 'sexo' => 'm', 'apelido' => 'Brasileirão', 'url' => 'https://chancedegol.com.br/br17.htm', 'status' => 0],
            ['idCampeonato' => $campeonato->id, 'temporada' => '2016', 'divisao' => 'Série A', 'sexo' => 'm', 'apelido' => 'Brasileirão', 'url' => 'https://chancedegol.com.br/br16.htm', 'status' => 0],
            ['idCampeonato' => $campeonato->id, 'temporada' => '2015', 'divisao' => 'Série A', 'sexo' => 'm', 'apelido' => 'Brasileirão', 'url' => 'https://chancedegol.com.br/br15.htm', 'status' => 0],
            ['idCampeonato' => $campeonato->id, 'temporada' => '2014', 'divisao' => 'Série A', 'sexo' => 'm', 'apelido' => 'Brasileirão', 'url' => 'https://chancedegol.com.br/br14.htm', 'status' => 0],
            ['idCampeonato' => $campeonato->id, 'temporada' => '2013', 'divisao' => 'Série A', 'sexo' => 'm', 'apelido' => 'Brasileirão', 'url' => 'https://chancedegol.com.br/br13.htm', 'status' => 0],
            ['idCampeonato' => $campeonato->id, 'temporada' => '2012', 'divisao' => 'Série A', 'sexo' => 'm', 'apelido' => 'Brasileirão', 'url' => 'https://chancedegol.com.br/br12.htm', 'status' => 0],
            ['idCampeonato' => $campeonato->id, 'temporada' => '2011', 'divisao' => 'Série A', 'sexo' => 'm', 'apelido' => 'Brasileirão', 'url' => 'https://chancedegol.com.br/br11.htm', 'status' => 0],
            ['idCampeonato' => $campeonato->id, 'temporada' => '2010', 'divisao' => 'Série A', 'sexo' => 'm', 'apelido' => 'Brasileirão', 'url' => 'https://chancedegol.com.br/br10.htm', 'status' => 0],
            ['idCampeonato' => $campeonato->id, 'temporada' => '2009', 'divisao' => 'Série A', 'sexo' => 'm', 'apelido' => 'Brasileirão', 'url' => 'https://chancedegol.com.br/br09.htm', 'status' => 0],
            ['idCampeonato' => $campeonato->id, 'temporada' => '2008', 'divisao' => 'Série A', 'sexo' => 'm', 'apelido' => 'Brasileirão', 'url' => 'https://chancedegol.com.br/br08.htm', 'status' => 0],
            ['idCampeonato' => $campeonato->id, 'temporada' => '2007', 'divisao' => 'Série A', 'sexo' => 'm', 'apelido' => 'Brasileirão', 'url' => 'https://chancedegol.com.br/br07.htm', 'status' => 0],
            ['idCampeonato' => $campeonato->id, 'temporada' => '2006', 'divisao' => 'Série A', 'sexo' => 'm', 'apelido' => 'Brasileirão', 'url' => 'https://chancedegol.com.br/br06.htm', 'status' => 0],
            ['idCampeonato' => $campeonato->id, 'temporada' => '2005', 'divisao' => 'Série A', 'sexo' => 'm', 'apelido' => 'Brasileirão', 'url' => 'https://chancedegol.com.br/br05.htm', 'status' => 0],
            ['idCampeonato' => $campeonato->id, 'temporada' => '2004', 'divisao' => 'Série A', 'sexo' => 'm', 'apelido' => 'Brasileirão', 'url' => 'https://chancedegol.com.br/br04.htm', 'status' => 0],
            ['idCampeonato' => $campeonato->id, 'temporada' => '2003', 'divisao' => 'Série A', 'sexo' => 'm', 'apelido' => 'Brasileirão', 'url' => 'https://chancedegol.com.br/br03.htm', 'status' => 0],
            ['idCampeonato' => $campeonato->id, 'temporada' => '2002', 'divisao' => 'Série A', 'sexo' => 'm', 'apelido' => 'Brasileirão', 'url' => 'https://chancedegol.com.br/br02.htm', 'status' => 0],
            ['idCampeonato' => $campeonato->id, 'temporada' => '2001', 'divisao' => 'Série A', 'sexo' => 'm', 'apelido' => 'Brasileirão', 'url' => 'https://chancedegol.com.br/br01.htm', 'status' => 0],
            ['idCampeonato' => $campeonato->id, 'temporada' => '2000', 'divisao' => 'Série A', 'sexo' => 'm', 'apelido' => 'Copa João Havelange', 'url' => 'https://chancedegol.com.br/jh00.htm', 'status' => 0],
            ['idCampeonato' => $campeonato->id, 'temporada' => '1999', 'divisao' => 'Série A', 'sexo' => 'm', 'apelido' => 'Brasileirão', 'url' => 'https://chancedegol.com.br/br99a.htm', 'status' => 0],
            ['idCampeonato' => $campeonato->id, 'temporada' => '1998', 'divisao' => 'Série A', 'sexo' => 'm', 'apelido' => 'Brasileirão', 'url' => 'https://chancedegol.com.br/br98a.htm', 'status' => 0],
        ]);
    }
}
