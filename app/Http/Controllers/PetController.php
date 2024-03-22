<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Http\Requests\StorePetRequest;
use App\Http\Requests\UpdatePetRequest;
use App\Repositories\DisabilityRepository;
use App\Repositories\GenderRepository;
use App\Repositories\MadrillaRepository;
use App\Repositories\PetsRepository;
use App\Repositories\SizeRepository;
use App\Repositories\StallionRepository;
use App\Repositories\SupplementRepository;
use App\Repositories\TrainingRepository;
use App\Repositories\VaccineAndMedicineRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Throwable;

class PetController extends Controller
{
    private $petsRepository;
    private $genderRepository;
    private $sizeRepository;
    private $stallionRepository;
    private $madrillaRepository;
    private $disabilityRepository;
    private $supplementRepository;
    private $vaccineAndMedicineRepository;
    private $trainingRepository;
    public function __construct(PetsRepository $petsRepository, GenderRepository $genderRepository, SizeRepository $sizeRepository, StallionRepository $stallionRepository, MadrillaRepository $madrillaRepository, DisabilityRepository $disabilityRepository, SupplementRepository $supplementRepository, VaccineAndMedicineRepository $vaccineAndMedicineRepository, TrainingRepository $trainingRepository){
        $this->middleware('auth');
        $this->petsRepository = $petsRepository;
        $this->genderRepository = $genderRepository;
        $this->sizeRepository = $sizeRepository;
        $this->stallionRepository = $stallionRepository;
        $this->madrillaRepository = $madrillaRepository;
        $this->disabilityRepository = $disabilityRepository;
        $this->supplementRepository = $supplementRepository;
        $this->vaccineAndMedicineRepository = $vaccineAndMedicineRepository;
        $this->trainingRepository = $trainingRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pets = $this->petsRepository->all();
        $genders = $this->genderRepository->all();
        $sizes = $this->sizeRepository->all();
        $stallions = $this->stallionRepository->all();
        $madrillas = $this->madrillaRepository->all();
        $disabilitys = $this->disabilityRepository->all();
        return Inertia::render('Pets/Index',compact('pets','genders','sizes','stallions','madrillas','disabilitys'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePetRequest $request)
    {
        try {
            DB::beginTransaction();

            $vaccineAndMedicineArray = $request['vaccineAndMedicineArray'];
            $trainingArray = $request['trainingArray'];
            $supplementArray = $request['supplementArray'];

            unset($request['vaccineAndMedicineArray']);
            unset($request['vaccine_and_medicine']);
            unset($request['trainingArray']);
            unset($request['training']);
            unset($request['supplementArray']);
            unset($request['supplement']);

            $user_id = Auth::id();
            $request['user_id'] = $user_id;
            $data = $this->petsRepository->store($request->all());

            if(count($vaccineAndMedicineArray) > 0){
                foreach ($vaccineAndMedicineArray as $key => $value) {
                    if(isset($value['delete'])){
                        $this->vaccineAndMedicineRepository->delete($value['id']);
                    }else{
                        unset($value['delete']);
                        $value['pet_id'] = $data->id;
                        $value['user_id'] = $user_id;
                        $this->vaccineAndMedicineRepository->store($value);
                    }
                }
                }
            if(count($trainingArray) > 0){
                foreach ($trainingArray as $key => $value) {
                    if(isset($value['delete'])){
                        $this->trainingRepository->delete($value['id']);
                    }else{
                        unset($value['delete']);
                        $value['pet_id'] = $data->id;
                        $value['user_id'] = $user_id;
                        $this->trainingRepository->store($value);
                    }
                }
            }
            if(count($supplementArray) > 0){
                foreach ($supplementArray as $key => $value) {
                    if(isset($value['delete'])){
                        $this->supplementRepository->delete($value['id']);
                    }else{
                        unset($value['delete']);
                        $value['pet_id'] = $data->id;
                        $value['user_id'] = $user_id;
                        $this->supplementRepository->store($value);
                    }
                }

            }

            DB::commit();
            $msg = 'agregado';
            if (! empty($request['id'])) {
                $msg = 'modificado';
            }
            return response()->json(['code' => 200, 'message' => 'Mascota creado correctamente', 'dataList' => $data]);

        } catch (Throwable $th) {
            DB::rollBack();
            return response()->json(['code' => 500, 'message' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pet $pet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            DB::beginTransaction();
            $data = $this->petsRepository->find(id:$id, with:['vaccineAndMedicine','training','supplement']);
            DB::commit();

            return response()->json(['code' => 200, 'data' => $data]);
        } catch (Throwable $th) {
            DB::rollBack();

            return response()->json(['code' => 500, 'message' => $th->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePetRequest $request, Pet $pet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pet $pet)
    {
        //
    }
}
