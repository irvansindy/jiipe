<div class="modal fade" id="modalCareer" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalCareerLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalCareerLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @php
                $factories = \App\Models\Factory::all();
                $locations = \App\Models\MasterCompanyLocation::all();
                $jobLevels = \App\Models\MasterJobLevel::all();
                $educations = \App\Models\MasterEducation::all();
            @endphp
            <form class="form_career" id="form_career">
                @csrf
                <div class="modal-body">
                    <div class="for-id">
                        <input type="hidden" id="career_id" name="career_id">
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12 mb-3">
                            <label for="career_position" class="form-label">Position</label>
                            <input type="text" class="form-control" id="career_position" name="career_position">
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 mb-3">
                            <label for="career_factory" class="form-label">Factory</label>
                            <select class="form-select select2" id="career_factory" name="career_factory">
                                <option value="">-- Select Factory --</option>
                                @foreach($factories as $factory)
                                    <option value="{{ $factory->id }}">{{ $factory->name }}</option>
                                @endforeach
                            </select>
                            <div class="text-danger" id="message_career_factory"></div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 mb-3">
                            <label for="career_location" class="form-label">Location</label>
                            <select class="form-select select2" id="career_location" name="career_location">
                                <option value="">-- Select Location --</option>
                                @foreach($locations as $location)
                                    <option value="{{ $location->id }}">{{ $location->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 mb-3">
                            <label for="career_job_level" class="form-label">Job Level</label>
                            <select class="form-select select2" id="career_job_level" name="career_job_level">
                                <option value="">-- Select Job Level --</option>
                                @foreach($jobLevels as $jobLevel)
                                    <option value="{{ $jobLevel->id }}">{{ $jobLevel->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- <div class="col-md-6 col-lg-6 col-sm-12 mb-3">
                            <label for="career_range_salary" class="form-label">Range Salary</label>
                            <input type="text" class="form-control" id="career_range_salary" name="career_range_salary">
                        </div> --}}

                        <div class="col-md-6 col-lg-6 col-sm-12 mb-3">
                            <label for="career_education" class="form-label">Minimum Education</label>
                            <select class="form-select select2" id="career_education" name="career_education">
                                <option value="">-- Select Education --</option>
                                @foreach($educations as $education)
                                    <option value="{{ $education->id }}">{{ $education->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 mb-3">
                            <label for="career_experience" class="form-label">Minimum Experience</label>
                            <input type="text" class="form-control" id="career_experience" name="career_experience">
                        </div>
                        <div class="col-md-12 col-lg-12 col-sm-12 mb-3">
                            <label for="career_description" class="form-label">Job Description</label>
                            <textarea class="form-control" id="career_description" name="career_description" rows="4"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" id="button_action_news_category">

                </div>
            </form>
        </div>
    </div>
</div>