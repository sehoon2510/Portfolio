# school
학교에서의 자습일지

## 깃 베쉬 사용법
깃 베쉬의 기본 사용방법을 정리했습니다. [참고링크](https://backendcode.tistory.com/165)

### 기본설정
깃 베쉬를 사용하기 전 기본설정
1. 로그인하기
    + `$ git config --global user.name <유저이름>`
    + `$ git config --global user.email <유저 이메일>`
    + 기존에 로그인이 이미 되어있다면, 다음 명령어로 정보를 확인할 수 있다.
        + `$ git config user.name`
        + `$ git config user.name`
2. 폴더 연결 및 기본설정 하기
    + 로그인정보를 등록했다면, 본인의 기기의 directorie를 선택하고 기본 파일들을 넣어주어야 한다.
        1. `$ cd <경로>`
        2. `$ git init`
    + 다음 순서대로 directorie를 선택하고 명령어를 입력했다면, 파일 탐색기에서 해당 directorie에 들어가 [보기]탭의 [숨긴 항목]를 활성화하면 <.git>이라는 폴더가 나타나면 성공이다.
3. Repositorie 연결하기
    + directorie를 연결하고 기본설정을 마쳤다면, github의 파일을 저장할 Repositorie를 연결해야 한다. 그러기 위해 해당 Repositorie의 연결 링크를 가져와야한다. 방법은 다음과 같다.
        1. github에 로그인 한다.
        2. 홈에서 [Repositories]탭에 들어간다.
        3. 연결할 [Repositorie]에 들어간다.
        4. 중간에 [Code]라는 버튼을 클릭하고 링크를 복사한다.
    + 다음 순서로 연결 링크를 가져왔다면 명령어를 입력한다.
        + `$ git remote add origin <LINK>`
        + 이 명령어를 입력하면 기본 branch가 등록된다.
4. 안전작업
    + 기본적으로 [Repositorie] 연결을 완료했다면 바로 작업을 시작해도 되지만, 안전을 위해 이 작업을 해보자
    + `$ git log`
        + 이 명령어는 commit을 한 것에 대한 로그를 출력시킨다.
    + `$ git switch -c <new-branch> <commit-code>`
        + 이 명령어는 [commit-code]에 해당하는 시점까지의 데이터를 복사해 새로운 내부 branch를 만든다.
    + `$ git switch <branch-name>`
        + 이 명령어는 현재 존재하는 branch중 선택되어있는 branch를 바꾼다.
    + `$ git pull origin <branch>`
        + 이 명령어는 [Repositorie]에 있는 branch의 데이터를 현재 선택된 directorie애 가져온다.
    + 이 작업들로 보다 안전하게 github를 관리할 수 있다.
5. 사용하기
    + 위의 작업을 다 마쳤다면 이제 작업을 시작하면 된다.
        + ###### add
            + 현재 directorie에 새로운 파일이나 폴더가 생성되었을 경우 실행합니다. (필수)
            + `$ git add < . or FileName>`
        + ###### commit
            + 현재까지의 진행상황을 저장합니다. [add]이후에 가능합니다.
            + `$ git commit -m <msg>` : 현재 진행상황을 저장합니다.
            + `$ git commit -a` : 선택된 directorie를 새로고침 합니다. [add]가 된 파일만 적용됩니다.
            + `$ git commit -am <msg>` : 선택된 directorie를 새로고침하고, 저장합니다. [add]가 된 파일만 적용됩니다.
        + ###### push
            + [commit]된 정보를 github에 업로드 합니다.
            + `$ git push origin <branch>`
            + `$ git push origin <branch1>:<branch2>` : 다른 branch1에 있는 정보를 branch2에 업로드 합니다.
        + ###### branch
            + [branch]와 관련된 명령어 입니다.
            + `$ git branch` : 현재 존재하는 모든 branch 리스트를 출력합니다.
            + `$ git branch -d <branch>` : branch를 삭제합니다.

