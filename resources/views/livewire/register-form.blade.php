<div>
    <h2 class="h4 text-title marbot20">Application Form / استمارة طلب</h2>

    <h2 class="h4 text-red marbot20">Student Information / معلومات الطالب</h2>
    <div class="form-group marbot20">
        <label for="txtSFName">Student Full Name / الاسم الكامل للطالب</label>
        <input wire:model.lazy="form.SFName" type="text" maxlength="100" class="form-control @error('form.SFName') is-invalid @enderror"
               onkeypress="return isNumericKey(event)"/>
        @error('form.SFName')
        <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
        @enderror
    </div>
    <div class="row">
        <div class="col-md-3 form-group marbot20">
            <label for="txtSNationlity">Nationality / الجنسية</label>
            <input wire:model.lazy="form.SNationlity" type="text" maxlength="20" class="form-control @error('form.SNationlity') is-invalid @enderror"
                   onkeypress="return isNumericKey(event)"/>
            @error('form.SNationlity')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="col-md-3 form-group marbot20">
            <label for="txtDOB">Date Of Birth / تاريخ الولادة</label>
            <div class="controls" style="display: flex;gap: 4px;">
                <select wire:model.lazy="form.dob-day" class="form-control form-control-sm @error('form.dob-day') is-invalid @enderror">
                    <option value="">Day</option>
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                    <option value="25">25</option>
                    <option value="26">26</option>
                    <option value="27">27</option>
                    <option value="28">28</option>
                    <option value="29">29</option>
                    <option value="30">30</option>
                    <option value="31">31</option>
                </select>
                <select wire:model.lazy="form.dob-month" class="form-control form-control-sm @error('form.dob-month') is-invalid @enderror">
                    <option value="">Month</option>
                    <option value="01">Jan</option>
                    <option value="02">Feb</option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">Aug</option>
                    <option value="09">Sep</option>
                    <option value="10">Oct</option>
                    <option value="11">Nov</option>
                    <option value="12">Dec</option>
                </select>
                <select wire:model.lazy="form.dob-year" class="form-control form-control-sm @error('form.dob-year') is-invalid @enderror">
                    <option value="">Year</option>
                    <option value="2020">2020</option>
                    <option value="2019">2019</option>
                    <option value="2018">2018</option>
                    <option value="2017">2017</option>
                    <option value="2016">2016</option>
                    <option value="2015">2015</option>
                    <option value="2014">2014</option>
                    <option value="2013">2013</option>
                    <option value="2012">2012</option>
                    <option value="2011">2011</option>
                    <option value="2010">2010</option>
                    <option value="2009">2009</option>
                    <option value="2008">2008</option>
                    <option value="2007">2007</option>
                    <option value="2006">2006</option>
                    <option value="2005">2005</option>
                    <option value="2004">2004</option>
                    <option value="2003">2003</option>
                    <option value="2002">2002</option>
                    <option value="2001">2001</option>
                    <option value="2000">2000</option>
                    <option value="1999">1999</option>
                    <option value="1998">1998</option>
                    <option value="1997">1997</option>
                    <option value="1996">1996</option>
                    <option value="1995">1995</option>
                    <option value="1994">1994</option>
                    <option value="1993">1993</option>
                    <option value="1992">1992</option>
                    <option value="1991">1991</option>
                    <option value="1990">1990</option>
                    <option value="1989">1989</option>
                    <option value="1988">1988</option>
                    <option value="1987">1987</option>
                    <option value="1986">1986</option>
                    <option value="1985">1985</option>
                    <option value="1984">1984</option>
                    <option value="1983">1983</option>
                    <option value="1982">1982</option>
                    <option value="1981">1981</option>
                    <option value="1980">1980</option>
                    <option value="1979">1979</option>
                    <option value="1978">1978</option>
                    <option value="1977">1977</option>
                    <option value="1976">1976</option>
                    <option value="1975">1975</option>
                    <option value="1974">1974</option>
                    <option value="1973">1973</option>
                    <option value="1972">1972</option>
                    <option value="1971">1971</option>
                    <option value="1970">1970</option>
                    <option value="1969">1969</option>
                    <option value="1968">1968</option>
                    <option value="1967">1967</option>
                    <option value="1966">1966</option>
                    <option value="1965">1965</option>
                    <option value="1964">1964</option>
                    <option value="1963">1963</option>
                    <option value="1962">1962</option>
                    <option value="1961">1961</option>
                    <option value="1960">1960</option>
                    <option value="1959">1959</option>
                    <option value="1958">1958</option>
                    <option value="1957">1957</option>
                    <option value="1956">1956</option>
                    <option value="1955">1955</option>
                    <option value="1954">1954</option>
                    <option value="1953">1953</option>
                    <option value="1952">1952</option>
                    <option value="1951">1951</option>
                    <option value="1950">1950</option>
                    <option value="1949">1949</option>
                    <option value="1948">1948</option>
                    <option value="1947">1947</option>
                    <option value="1946">1946</option>
                    <option value="1945">1945</option>
                    <option value="1944">1944</option>
                    <option value="1943">1943</option>
                    <option value="1942">1942</option>
                    <option value="1941">1941</option>
                    <option value="1940">1940</option>
                    <option value="1939">1939</option>
                    <option value="1938">1938</option>
                    <option value="1937">1937</option>
                    <option value="1936">1936</option>
                    <option value="1935">1935</option>
                    <option value="1934">1934</option>
                    <option value="1933">1933</option>
                    <option value="1932">1932</option>
                    <option value="1931">1931</option>
                    <option value="1930">1930</option>
                    <option value="1929">1929</option>
                    <option value="1928">1928</option>
                    <option value="1927">1927</option>
                    <option value="1926">1926</option>
                    <option value="1925">1925</option>
                    <option value="1924">1924</option>
                    <option value="1923">1923</option>
                    <option value="1922">1922</option>
                    <option value="1921">1921</option>
                    <option value="1920">1920</option>
                    <option value="1919">1919</option>
                    <option value="1918">1918</option>
                    <option value="1917">1917</option>
                    <option value="1916">1916</option>
                    <option value="1915">1915</option>
                    <option value="1914">1914</option>
                    <option value="1913">1913</option>
                    <option value="1912">1912</option>
                    <option value="1911">1911</option>
                    <option value="1910">1910</option>
                    <option value="1909">1909</option>
                    <option value="1908">1908</option>
                    <option value="1907">1907</option>
                    <option value="1906">1906</option>
                    <option value="1905">1905</option>
                    <option value="1904">1904</option>
                    <option value="1903">1903</option>
                    <option value="1901">1901</option>
                    <option value="1900">1900</option>
                </select>
            </div>

        </div>

        <div class="col-md-3 form-group marbot20">
            <label for="txtSex">Sex / الجنس</label>
            <select wire:model.lazy="form.Sex" class="form-control @error('form.Sex') is-invalid @enderror">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
            @error('form.Sex')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="col-md-3 form-group marbot20">
            <label for="txtSCivilId">Student Civil ID / الرقم المدني للطالب</label>
            <input wire:model.lazy="form.SCivilId" type="text" maxlength="12" class="form-control @error('form.SCivilId') is-invalid @enderror"
                   onkeypress="return isNumberKey(event)"/>
            @error('form.SCivilId')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="row">


        <div class="col-md-3 form-group marbot20">
            <label for="txtSPreviousSchool">Previous School Name / اسم المدرسة السابقة</label>
            <input wire:model.lazy="form.SPreviousSchool" type="text" maxlength="100" class="form-control @error('form.SPreviousSchool') is-invalid @enderror"
                   onkeypress="return isNumericKey(event)"/>
            @error('form.SPreviousSchool')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="col-md-3 form-group marbot20">
            <label for="txtSCurricullum">Curriculum / المنهج المتبع في المدرسة السابقة</label>
            <input wire:model.lazy="form.SCurricullum" type="text" maxlength="50" class="form-control @error('form.SCurricullum') is-invalid @enderror"/>
            @error('form.SCurricullum')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="col-md-3 form-group marbot20">
            <label for="txtGrade">Grade Applied For / الصف المتقدم له</label>
            <select wire:model.lazy="form.Grade" class="form-control @error('form.Grade') is-invalid @enderror">
                @foreach($grades as $grade)
                    <option value="{{ $grade->id }}">{{ $grade->title }}: {{ number_format($grade->price) }} KD</option>
                @endforeach
            </select>
            @error('form.Grade')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

    </div>
    <div class="form-group marbot20">
        <label for="txtSHAddress">Home Address / عنوان المنزل</label>
        <input wire:model.lazy="form.SHAddress" type="text" maxlength="150" class="form-control @error('form.SHAddress') is-invalid @enderror"/>
        @error('form.SHAddress')
        <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
        @enderror
    </div>

    <h2 class="h4 text-red marbot20">Father Information / معلومات الأب</h2>
    <div class="form-group marbot20">
        <label for="txtFName">Father Full Name / الاسم الكامل للأب</label>
        <input wire:model.lazy="form.FName" type="text" maxlength="100" class="form-control @error('form.FName') is-invalid @enderror"
               onkeypress="return isNumericKey(event)"/>
        @error('form.FName')
        <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
        @enderror
    </div>
    <div class="row">
        <div class="col-md-3 form-group marbot20">
            <label for="txtFNationlity">Nationality / الجنسية</label>
            <input wire:model.lazy="form.FNationlity" type="text" maxlength="20" class="form-control @error('form.FNationlity') is-invalid @enderror"
                   onkeypress="return isNumericKey(event)"/>
            @error('form.FNationlity')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="col-md-3 form-group marbot20">
            <label for="txtFCivilId">Father Civil ID / الرقم المدني للأب</label>
            <input wire:model.lazy="form.FCivilId" type="text" maxlength="12" class="form-control @error('form.FCivilId') is-invalid @enderror"
                   onkeypress="return isNumberKey(event)"/>
            @error('form.FCivilId')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="col-md-3 form-group marbot20">
            <label for="txtFMobile">Mobile / رقم الموبايل</label>
            <input wire:model.lazy="form.FMobile" type="text" maxlength="8" class="form-control @error('form.FMobile') is-invalid @enderror"
                   onkeypress="return isNumberKey(event)"/>
            @error('form.FMobile')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

        </div>

        <div class="col-md-3 form-group marbot20">
            <label for="txtFEmail">Email / البريد الإلكتروني</label>
            <input wire:model.lazy="form.FEmail" class="form-control @error('form.FEmail') is-invalid @enderror" type="email"/>
            @error('form.FEmail')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

        </div>


    </div>
    <div class="row">
        <div class="col-md-3 form-group marbot20">
            <label for="txtFOccupation">Occupation / الوظيفة</label>
            <input wire:model.lazy="form.FOccupation" type="text" maxlength="50" class="form-control @error('form.FOccupation') is-invalid @enderror"
                   onkeypress="return isNumericKey(event)"/>
            @error('form.FOccupation')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="col-md-9 form-group marbot20">
            <label for="txtFBAddress">Business Address / عنوان العمل</label>
            <input wire:model.lazy="form.FBAddress" type="text" maxlength="150" class="form-control @error('form.FBAddress') is-invalid @enderror"/>
            @error('form.FBAddress')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

    </div>

    <h2 class="h4 text-red marbot20">Mother Information / معلومات الأم</h2>
    <div class="form-group marbot20">
        <label for="txtMName">Mother Full Name / الاسم الكامل للأم</label>
        <input wire:model.lazy="form.MName" type="text" maxlength="100" class="form-control @error('form.MName') is-invalid @enderror"
               onkeypress="return isNumericKey(event)"/>
        @error('form.MName')
        <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
        @enderror
    </div>
    <div class="row">

        <div class="col-md-3 form-group marbot20">
            <label for="txtMNationlity">Nationality / الجنسية</label>
            <input wire:model.lazy="form.MNationlity" type="text" maxlength="20" class="form-control @error('form.MNationlity') is-invalid @enderror"
                   onkeypress="return isNumericKey(event)"/>
            @error('form.MNationlity')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="col-md-3 form-group marbot20">
            <label for="txtMCivilId">Mother Civil ID / الرقم المدني للأم</label>
            <input wire:model.lazy="form.MCivilId" type="text" maxlength="12" class="form-control @error('form.MCivilId') is-invalid @enderror"
                   onkeypress="return isNumberKey(event)"/>
            @error('form.MCivilId')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


        <div class="col-md-3 form-group marbot20">
            <label for="txtMMobile">Mobile / رقم الموبايل</label>
            <input wire:model.lazy="form.MMobile" type="text" maxlength="8" class="form-control @error('form.MMobile') is-invalid @enderror"
                   onkeypress="return isNumberKey(event)"/>
            @error('form.MMobile')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

        </div>

        <div class="col-md-3 form-group marbot20">
            <label for="txtMEmail">Email / البريد الإلكتروني</label>
            <input wire:model.lazy="form.MEmail" class="form-control @error('form.MEmail') is-invalid @enderror" type="email"/>
            @error('form.MEmail')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


    </div>
    <div class="row">
        <div class="col-md-3 form-group marbot20">
            <label for="txtMOccupation">Occupation / الوظيفة</label>
            <input wire:model.lazy="form.MOccupation" type="text" maxlength="50" class="form-control @error('form.MOccupation') is-invalid @enderror"
                   onkeypress="return isNumericKey(event)"/>
            @error('form.MOccupation')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-9 form-group marbot20">
            <label for="txtMBAddress">Business Address / عنوان العمل</label>
            <input wire:model.lazy="form.MBAddress" type="text" maxlength="150" class="form-control @error('form.MBAddress') is-invalid @enderror"/>
            @error('form.MBAddress')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 form-group marbot20">
            <label for="txtHowDidYouKnow">How did you know about Iqra'a American School ? كيف عرفت عن مدرسة اقرأ
                الأمريكية؟</label>
            <input wire:model.lazy="form.HowDidYouKnow" type="text" maxlength="150" class="form-control @error('form.HowDidYouKnow') is-invalid @enderror"
                   onkeypress="return isNumericKey(event)"/>
            @error('form.HowDidYouKnow')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

    </div>

    <div class="text-right">
        <button type="button" wire:model.lazy="form.btnSubmit" class="btn btn-g" style="background-color: #BC9660;"
                wire:loading.attr="disabled"
                wire:click.prevent="save"
        >Submit
        </button>
    </div>
    <div class="row" style="padding: 10px;"></div>
    <div class="row" style="padding: 10px;">
        <span style="color:#EC624B;font-weight:bold;"></span>
    </div>
</div>
